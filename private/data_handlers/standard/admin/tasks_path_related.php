<?php
/**
 * @file
 * Path-generation related admin tasks.
 *
 * Currently handled tasks are:
 *
 * - Rebuilding path cache.
 * - Refreshing xml sitemaps.
 */


/**
 * Admin function for rebuilding path cache.
 */
function rebuild_path_cache() {
  apputils_wake_resource('definitions', 'pages');

  // Prepare containers for results.
  $collected_paths = array();
  $locale_keys     = array();
  foreach($GLOBALS['config']['document']['locale'] as $locale_key => $suff_i_dont_need) {
    $locale_keys[] = $locale_key; // TODO: write this into the registry!
    $collected_paths[$locale_key] = array();
  }
  unset($locale_key, $suff_i_dont_need);

  // Collect paths.
  foreach ($GLOBALS['definitions']['pages'] as $page_id => $page_data) {
    foreach($locale_keys as $locale_key) {
      if (!empty($page_data['paths'][$locale_key])) {
        $collected_paths[$locale_key][] =
          $page_data['paths'][$locale_key] . ':' . $page_id;
      }
    }
    unset($locale_key);
  }
  unset($page_id, $page_data);

  // Write the contents of the collections into files as per locale.
  foreach ($locale_keys as $locale_key) {
    $cache_file = $GLOBALS['registry']['app_current']['cache']
      . '/cache_paths_' . $locale_key . '_locale.txt';
    $content = implode("\n", $collected_paths[$locale_key]);

    $object_file = fopen($cache_file, "w");
    fwrite($object_file, $content);
    fclose($object_file);

    $number_of_paths = count($collected_paths[$locale_key]);
    $message = 'Had written <em>' . $number_of_paths . '</em> paths into the <em>'
      . ensafe_string($locale_key, 'attribute_name') . ' locale</em> path cache.';
    sys_notify($message);
  }
  unset($page_id, $page_data);
}

/**
 * Admin function for rebuilding xml sitemaps.
 */
function regenerate_xml_sitemaps() {
  apputils_wake_resource('definitions', 'pages');

  $sitemap_config = $GLOBALS['config']['xml_sitemap_generator'];

  // Prepare containers for results.
  $collected_paths = array();
  $locale_keys     = array();
  foreach($GLOBALS['config']['document']['locale'] as $locale_key => $suff_i_dont_need) {
    $locale_keys[] = $locale_key; // TODO: write this into the registry!
    $collected_paths[$locale_key] = array();
  }
  unset($locale_key, $suff_i_dont_need);

  if (empty($sitemap_config['domain'][LOCALE_KEY])) {
    sys_notify('Insufficient setup for the XML sitemap generator.');
    apputils_exit_nicely();
  }

  // Collect paths.
  $items_at_play = array();
  foreach ($GLOBALS['definitions']['pages'] as $page_id => $page_data) {
    if (!empty($page_data['xml_sitemap_include'])) {
      if ($page_data['data_type'] == 'entity') {
        $fetch_opts['entity_only_meta'] = TRUE;
        datautils_data_fetcher($page_data, $fetch_opts);
        if (!empty($GLOBALS['temp']['entity_metadata'][$page_data['instance_id']]['meta']['is_published'])) {
          $items_at_play[$page_id] = $page_data;
        }
      }
      elseif ($page_data['data_type'] == 'binder'
              && !empty($page_data['is_published'])) {
        $items_at_play[$page_id] = $page_data;
      }
    }
  }
  // unset($page_id, $page_data);

  foreach ($items_at_play as $page_id => $page_data) {
    foreach($locale_keys as $locale_key) {
      if (array_key_exists($locale_key, $page_data['paths'])) {
        $collected_paths[$locale_key][] = array(
          'page_id' => $page_id,
          'path'    => $page_data['paths'][$locale_key],
        );
      }
    }
    unset($locale_key);
  }
  // unset($page_id, $page_data);

  // Write the contents of the collections into files as per locale.
  foreach ($locale_keys as $locale_key) {
    $filename = ensafe_string($sitemap_config['sitemap_name'], 'attribute_value')
      . '_' . str_replace('.', '_', ensafe_string($sitemap_config['domain'][$locale_key], 'file_name'))
      . '.xml';
    // NOTE: TBH I'm not sure why and how would one put a sitemap.xml into a
    // subdirectory of a domain. Is there such a thing as "scoped sitemap.xml"?
    $sitemap = SCRIPT_ROOT . $filename;
    $base_path_opts = array(
      'environment' => 'live',
      'for_locale'  => $locale_key,
    );
    // @see http://www.sitemaps.org/protocol.html
    $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $content .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
    // The homepage has to be inserted manually, because it couldn't be
    // detected due to its empty path string.
    foreach ($collected_paths[$locale_key] as $path) {
      $content .= '  <url><loc>' . base_path($base_path_opts) . $path['path'] . "</loc></url>\n";
    }
    $content .= "</urlset>\n";

    $object_file = fopen($sitemap, "w");
    fwrite($object_file, $content);
    fclose($object_file);

    $message = 'Updated sitemap <em>' . $filename . '</em>';
    sys_notify($message);
  }
  unset($locale_key);
}
