<?php
/**
 * @file
 * Utilities for sorting out 'page' tasks.
 */

/**
 * Read the external list of known paths.
 */
function pageutils_import_paths_from_cache($registry, $request, &$temp, &$datapool) {
  $paths_file = $registry['app_current']['cache']
    . '/cache_paths_' . LOCALE_KEY . '_locale.txt';
  if (file_exists($paths_file)) {
    $paths = file_get_contents($paths_file);
    $temp['raw_paths'] = preg_split("/\r\n|\n|\r/", $paths);
    foreach($temp['raw_paths'] as $raw_path) {
      // Now we only need the path part, without the page_id.
      $datapool['paths'][] = strtok($raw_path, ':');
      // page_id will be looked up only once, later, if the requested path
      // matches a defined one.
    }
    unset($raw_path, $substrings);
  }
  else {
    sys_notify('Error: the application could not find the list of paths.', 'alert');
    apputils_exit_nicely();
  }
}

/**
 * Define system pages: e.g.: 403, 404, admin.
 *
 * Okay. I think I get it.
 *
 * So these are pages that I - for some reason - didn't want to put into
 * definitions--pages.php. But the $definitions['pages'] array needs to contain
 * them, therefore, that array gets amended with this list.
 *
 * What matters is that the data fetching mechanism will need an input that
 * contains the entity identifiers (note that the page_id, however looks the
 * same as the instance_id, is not any use for the data_fetcher.
 *
 * The reason that a 410 system page is not here is that 410 pages get placed
 * into the regular page definition file. Same is true with 301 situations.
 *
 * I recognize and acknowledge that this is confusing.
 */
function pageutils_define_system_pages(&$definitions) {
  $definitions['pages']['http-403'] = array(
    'data_type'            => 'entity',
    'entity_type'          => 'dynamic',
    'instance_id'          => 'http-403',
  );
  $definitions['pages']['http-404'] = array(
    'data_type'            => 'entity',
    'entity_type'          => 'dynamic',
    'instance_id'          => 'http-404',
  );
  // The path info is needed for:
  // 1. The page-level language switcher.
  // 2. The path-cache generator freaks out if they are not here. Also, the
  //    path cache generator _needlessly_ puts the admin path into the path
  //    cache. Needlessly, because the admin path gets recognized without the
  //    cache, as it is a "watched path fragment" type of path (that got set
  //    in config.php).
  $definitions['pages']['admin-interface'] = array(
    'data_type'            => 'entity',
    'entity_type'          => 'dynamic',
    'instance_id'          => 'admin-interface',
    'has_translations'     => TRUE,
    'paths' => [
      'primary'   => $GLOBALS['config']['app']['admin_path'],
      'secondary' => $GLOBALS['config']['app']['admin_path'],
    ],
  );
}

/**
 * CSS and JS asset provider.
 *
 * @global array $config
 * @param string $return_type
 *   Recognized values:
 *   - inline_styles
 *   - head_css
 *   - head_js
 *   - body_js
 * @return string
 *   Rendered <style>, <link> and <script> tags.
 */
function pageutils_document_assets($return_type) {
  global $registry, $config, $request;

  $output = '';

  if (!empty($config['theme']['version'])) {
    $theme_version = '?v=' . $config['theme']['version'];
  }
  else {
    $theme_version = '';
  }

  // CSS.
  if ($return_type == 'head_css') {
    if (!empty($config['ui']['css_inline'])) {
      $output .= "<style>\n";
      foreach ($config['ui']['css_inline'] as $inline) {
        if ($inline['source'] == 'theme_generated') {
          $file = $registry['app_internals']['theme'] . '/css/'
            . ensafe_string($inline['file'], 'path_with_file_name');
        }
        if (!empty($file) && file_exists($file)) {
          $output .= ensafe_string(file_get_contents($file), 'inline_css');
        }
      }
      $output .= "\n</style>\n";
    }
    if (!empty($config['ui']['css_external'])) {
      foreach ($config['ui']['css_external'] as $external) {
        $path = ''; // Being reset for each file.
        if ($external['source'] == 'frontend_library') {
          $path = $registry['app_externals']['libraries_frontend'] . '/';
        }
        elseif ($external['source'] == 'theme_generated') {
          $path = $registry['app_externals']['theme'] . '/css/';
        }
        elseif ($external['source'] == 'theme_static') {
          $path = $registry['app_externals']['theme'] . '/css-static/';
        }
        elseif ($external['source'] == 'frontend_asset') {
          $path = $registry['app_externals']['assets_frontend'] . '/css/';
        }
        if (!empty($path)) {
          $output .= '<link rel="stylesheet" type="text/css" href="'
            . $path . ensafe_string($external['file'], 'path_with_file_name')
            . $theme_version . '">' . "\n";
        }
      }
    }
    return $output;
  }
  // JS.
  elseif ($return_type == 'head_js') {
    if (!empty($config['ui']['js_head_dependency'])) {
      foreach ($config['ui']['js_head_dependency'] as $resource) {
        $output .= _include_script($resource, $theme_version);
      }
    }
    if (!empty($config['ui']['js_settings_insertion'])
        && $config['ui']['js_settings_insertion'] == 'head') {
      $output .= _create_js_settings();
    }
    if (!empty($config['ui']['js_head'])) {
      foreach ($config['ui']['js_head'] as $resource) {
        $output .= _include_script($resource, $theme_version);
      }
    }
    return $output;
  }
  elseif ($return_type == 'body_js') {
    if (!empty($config['ui']['js_body_dependency'])) {
      foreach ($config['ui']['js_body_dependency'] as $resource) {
        $output .= _include_script($resource, $theme_version);
      }
    }
    if (!empty($config['ui']['js_settings_insertion'])
        && $config['ui']['js_settings_insertion'] == 'body') {
      $output .= _create_js_settings();
    }
    if (!empty($config['ui']['js_body'])) {
      foreach ($config['ui']['js_body'] as $resource) {
        $output .= _include_script($resource, $theme_version);
      }
    }
    return $output;
  }
  else {
    $message = 'Unrecognized return_type parameter for pageutils_document_assets(): <em>'
             . ensafe_string($return_type) . '</em>';
    sys_notify($message, 'warning');
  }
}

/**
 * Helper to draw a script tag.
 */
function _include_script($script_data, $theme_version) {
  global $config, $registry;

  // TODO: support attributes.
  if ($script_data['source'] == 'cdn') {
    $output = '<script src="' . ensafe_string($script_data['file'], 'path_with_file_name')
            . '"></script>' . "\n";
  }
  else {
    if ($script_data['source'] == 'frontend_library') {
      $path = $registry['app_externals']['libraries_frontend'] . '/';
    }
    elseif ($script_data['source'] == 'frontend_asset') {
      $path = $registry['app_externals']['assets_frontend'] . '/js/';
    }
    elseif ($script_data['source'] == 'theme') {
      $path = $registry['app_externals']['theme'] . '/js/';
    }
    elseif (!empty($config['app']['dev_mode'])) {
      $message = 'Unrecognized script source type: <em>'
               . ensafe_string($script_data['source']) . '</em>.';
      sys_notify($message);
    }
    $output = '<script src="' . $path
            . ensafe_string($script_data['file'], 'path_with_file_name')
            . $theme_version . '"></script>' . "\n";
  }
  return $output;
}

/**
 * Prepare and render a JS settings object reflecting actual page data.
 */
function _create_js_settings() {
  global $request;

  $settings_items = array();
  $settings_items['basePath'] = base_path();
  if (!empty($request['page_id'])) {
    $settings_items['pageId'] = ensafe_string($request['page_id'], 'attribute_value');
  }
  $settings = json_encode($settings_items, JSON_FORCE_OBJECT);
  $script = "<script>\n"
          . 'window.awrS = ' . $settings . ";\n"
          . "window.awrA = {};\n" // awrA (Assets) will be populated via system.js.
          . '</script>' . "\n";
  return $script;
}

/**
 * Provide HTML <head>'s contents.
 *
 * Note: the following had proved to be not sophisticated enough.
 */
function pageutils_html_head() {
  global $config, $request, $definitions;

  if (!empty($request['page_data']['page_title'])
      && $request['page_id'] != 'home') {
    $title = ensafe_string($request['page_data']['page_title'])
           . ' | ' . loc('site-name');
  }
  elseif ($request['page_id'] == 'home'
          && !empty($definitions['string_translations'][LOCALE_KEY]['site-tagline-1'])) {
    $title = loc('site-tagline-1') . ' | ' . loc('site-name');
  }
  else {
    $title = loc('site-name');
  }

  $output = '';
  $output .= '<meta charset="utf-8">' . "\n";
  $output .= '<title>' . strip_tags($title) . "</title>\n";
  if (!empty($request['page_data']['meta_descriptions'][LOCALE_KEY])) {
    $output .= '<meta name="description" content="'
      . ensafe_string($request['page_data']['meta_descriptions'][LOCALE_KEY]) . "\">\n";
  }
  if (!empty($request['contexts'])
      && in_array('noindex', $request['contexts'])) {
    $output .= '<meta name="robots" content="noindex">' . "\n";
  }

  if (!empty($config['app']['head_additions'])) {
    $output .= implode("\n", $config['app']['head_additions']) . "\n";
  }
  if (!empty($config['theme']['head_additions'])) {
    $output .= implode("\n", $config['theme']['head_additions']) . "\n";
  }

  $output .= pageutils_document_assets('head_css');

  $output .= implode("\n", array(
    "<script>",
    "document.documentElement.className = ",
    "document.documentElement.className.replace(/(?:^|\s)no-js(?!\S)/g , 'has-js');",
    "</script>"
  )) . "\n";

  $html5shiv = $GLOBALS['registry']['app_externals']['libraries_frontend']
        . '/html5shiv/dist/html5shiv.min.js';
  $respondjs = $GLOBALS['registry']['app_externals']['libraries_frontend']
        . '/respond-minmax/dest/respond.min.js';
  $output .= implode("\n", array(
    "<!--[if lt IE 9]>",
    "<script>document.documentElement.className += ' lt-ie9';</script>",
    "<script src='" . $html5shiv . "'></script>",
    "<script src='" . $respondjs . "'></script>",
    "<![endif]-->",
  )) . "\n";

  $output .= pageutils_document_assets('head_js');

  return $output;
}

/**
 * Reset all CSS.
 *
 * NOTE: not much thought went into this yet.
 */
function pageutils_reset_styles($mode = 'all') {
  if ($mode == 'all') {
    $GLOBALS['config']['ui']['css_inline'] = array();
    $GLOBALS['config']['ui']['css_external'] = array();
  }
}

/**
 * Reset all JS.
 *
 * NOTE: not much thought went into this yet.
 */
function pageutils_reset_javascripts($mode = 'all') {
  if ($mode == 'all') {
    $GLOBALS['config']['ui']['js_head'] = array();
    $GLOBALS['config']['ui']['js_body'] = array();
  }
}
