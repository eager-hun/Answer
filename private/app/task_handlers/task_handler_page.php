<?php
/**
 * @file
 * Task handler for task type page.
 */

// Grabbing page-task-specific utilities.
require_once($registry['app_internals']['utilities'] . '/utility_page.php');

// Establishing page data ('home' and 'admin' pages do already have their id).
if (empty($request['page_id'])) {
  // Bring in known paths.
  pageutils_import_paths_from_cache($registry, $request, $temp, $datapool);
  if (empty($config['env']['working_dir'])) {
    $prepared_uri_path = $request['uri_path'];
  }
  else {
    $to_trim = $config['env']['working_dir'] . '/';
    $prepared_uri_path = substr($request['uri_path'], strlen($to_trim));
  }
  // Decide the page_id by comparing the path to our path records.
  if (($index = array_search($prepared_uri_path, $datapool['paths'])) !== FALSE) {
    $path_record = $temp['raw_paths'][$index];
    $request['page_id'] = ltrim(strstr($path_record, ':'), ':');
  }
  // Else 404.
  else {
    if (!empty($config['app']['fast_404'])) {
      $header = $request['server_protocol'] . " 404 Not Found";
      sys_notify(loc('http-404'), 'warning');
      apputils_exit_nicely($header);
    }
    else {
      $request['page_id'] = 'http-404';
    }
  }
}
// Get to know page data.
apputils_wake_resource('definitions', 'pages');
// Amend the page definitions with system pages: 404, 403, and admin.
pageutils_define_system_pages($definitions);
// Grabbing binder definitions.
apputils_wake_resource('definitions', 'binders');
// Grabbing theme settings.
require_once($registry['app_internals']['theme'] . '/theme_settings.php');

// if (is_dev_mode('verbose')) {
//   $message = 'page_id is <code>'
//     . ensafe_string($request['page_id'], 'attribute_value') . '</code>.';
//   sys_notify($message);
//
//   apputils_wake_resource('data_handler', 'content_generator');
//   dh_content_generator('');
// }

// Response modifiers, 1: Unpublished content.
$page_data_temp = $definitions['pages'][$request['page_id']];
if ($page_data_temp['data_type'] == 'entity') {
  // Do a premature fetch of the primary entity.
  // (Most static entities that get requested as primary page content can take
  // this (because they are not interested in 'context' and 'section' data).
  $fetch_opts['entity_only_meta'] = TRUE;
  datautils_data_fetcher($page_data_temp, $fetch_opts);

  if (empty($temp['entity_metadata'][$page_data_temp['instance_id']]['meta']['is_published'])) {
    if (!is_admin()) {
      // Overwriting the $request with the 403 page.
      $request['page_id'] = 'http-403';
    }
    else {
      $request['contexts'][] = 'unpublished';
    }
  }
}
if ($page_data_temp['data_type'] == 'binder'
    && empty($page_data_temp['is_published'])) {
  if (!is_admin()) {
    // Overwriting the $request with the 403 page.
    $request['page_id'] = 'http-403';
  }
  else {
    $request['contexts'][] = 'unpublished';
  }
}

if (is_admin()) {
  $request['contexts'][] = 'admin';
}

// Making the finally set page's properties available system-wide.
$request['page_data'] = $definitions['pages'][$request['page_id']];


// #############################################################################
// Identify section and context data.

if (!empty($request['page_data'])) {
  // Section.
  if (!empty($request['page_data']['in_section'])) {
    $sections_by_page = array($request['page_data']['in_section']);
    if (!empty($definitions['sections'])) {
      foreach($definitions['sections'] as $mainsection => $subsections) {
        if (in_array($request['page_data']['in_section'], $subsections)) {
          array_unshift($sections_by_page, $mainsection);
          break;
        }
      }
      unset($mainsection, $subsections);
    }
    $request['sections'] = array_merge($sections_by_page, $request['sections']);
  }

  // Context.
  if (!empty($request['page_data']['in_context'])) {
    $contexts_by_page = explode(',', $request['page_data']['in_context']);
    $request['contexts'] = array_merge($contexts_by_page, $request['contexts']);

    // TODO: we should find this and alike actions a better place.
    if (in_array('deprecated', $contexts_by_page)) {
      $request['page_data']['template_variant'] = 'page_plain';
    }
  }
}

// Further context checks.
if (!empty($definitions['contexts']['by_section'])) {
  foreach($definitions['contexts']['by_section'] as $context => $sections) {
    if (array_intersect($sections, $request['sections'])) {
      $request['contexts'][] = $context;
      break;
    }
  }
  unset($context, $sections);
}
if (!empty($definitions['contexts']['by_uri']) && !empty($request['uri_path'])) {
  foreach($definitions['contexts']['by_uri'] as $context => $uris) {
    foreach ($uris as $uri) {
      $uri_prepared = str_replace('/', '\/', $uri);
      $pattern = '/^' . $uri_prepared . '/';
      if (preg_match($pattern, $request['uri_path'])) {
        $request['contexts'][] = $context;
        break;
      }
    }
  }
  unset($context, $uris, $uri);
}

/*
TODO: if you don't remember why it's here and everything works well, then
delete this all.
// Adding default section and context if none yet (but, why?).
if (empty($request['sections'])) {
  $request['sections'][] = 'default';
}
if (empty($request['contexts'])) {
  $request['contexts'][] = 'default';
}
*/

// ###########################################################################
// Building and rendering page contents.

// Fetch the primary content.
// Note:
// 1. The primary content may need 'section' and 'context' info, and we had to
//    wait for those until now.
// 2. The primary content has to be fetched prior to other page elements,
//    as they may need this info.
// 3. So it is now.
datautils_data_fetcher($request['page_data']);

// Set page title.
if ($request['page_data']['data_type'] == 'entity'
    && !empty($temp['raw_entities'][$request['page_data']['instance_id']]['fields']['field_title']['field_content'])) {
    $request['page_data']['page_title'] =
      $temp['raw_entities'][$request['page_data']['instance_id']]['fields']['field_title']['field_content'];
}
elseif ($request['page_data']['data_type'] == 'binder'
        && !empty($definitions['binders'][$request['page_data']['instance_id']]['binder_options']['title'][LOCALE_ID])) {
  $request['page_data']['page_title'] =
    $definitions['binders'][$request['page_data']['instance_id']]['binder_options']['title'][LOCALE_ID];
}

// Updating <body> attributes.
foreach ($request['sections'] as $section) {
  $temp['raw_attributes']['body']['class'][] =
    'section--' . ensafe_string($section, 'attribute_value');
}
foreach ($request['contexts'] as $context) {
  $temp['raw_attributes']['body']['class'][] =
    'context--' . ensafe_string($context, 'attribute_value');
}

// Decide wich page template variant to use.
if (empty($request['page_data']['template_variant'])) {
  $request['page_data']['template_variant'] = 'page_default';
}
$template_name = $request['page_data']['template_variant'];
// Fetch data.
$common_args = array(
  'data_type'   => 'binder',
  'instance_id' => $template_name,
  'output_type' => 'html',
  'present_as'  => $template_name,
  'requestor'   => 'page',
);
datautils_data_fetcher($common_args);

// Hack. We update the sys_notifications 'placeholder' entity's content now.
// We wanted to delay this as much as we could, at least until all binders and
// entities got fetched.
$temp['raw_entities']['sys_notifications']['fields']['field_body']['field_content'] =
  process_sys_notifications($sys_notifications_pool);

// Render data.
$html_body = templateutils_data_dresser($common_args);


// ###########################################################################
// Rendering the HTML document.

$temp['raw_attributes']['html'] = array(
  'lang' => $request['locale']['langcode'],
);
$html_doc_args = array(
  'variables' => array(
    'html_attributes' => templateutils_render_html_attributes($temp['raw_attributes']['html']),
    'head_attributes' => templateutils_render_html_attributes($temp['raw_attributes']['head']),
    'head_content'    => pageutils_html_head($config, $request, $definitions),
    'body'            => $html_body,
  ),
);

$html_doc_args['template_name'] = 'html_document';
$response = templateutils_present($html_doc_args);


// #############################################################################
// Sending response.

datautils_send_standard_headers($request);
if (!empty($response)) {
  print $response;
}

