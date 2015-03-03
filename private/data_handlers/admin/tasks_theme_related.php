<?php
/**
 * @file
 * Theme-related admin tasks.
 */


/**
 * Admin function for rebuilding theme registry.
 */
function rebuild_theme_registry() {
  _rediscover_present_agents();

  sys_notify('Updated theme registry.');
}

/**
 * Rediscover and build a simple cache of known present agents.
 *
 * This function should be run every time the templates' include source
 * (system vs theme) or the active theme is changed.
 */
function _rediscover_present_agents() {
  // Finding existing present_agents.
  $pa_directory = $GLOBALS['registry']['app_current']['present_agents'];
  $found_present_agents = array();
  $directory_items = array_diff(scandir($pa_directory), array('..', '.'));
  foreach ($directory_items as $item) {
    if ($item != 'README') {
      $pa_name = preg_replace('/^pa_/', '', $item);
      $pa_name = preg_replace('/.php$/', '', $pa_name);
      $found_present_agents[] = $pa_name;
    }
  }
  $cache_new_content = implode("\n",$found_present_agents);

  $cache_file = $GLOBALS['registry']['app_current']['cache']
    . '/cache_present_agents.txt';
  $object_file = fopen($cache_file, "w");
  fwrite($object_file, $cache_new_content);
  fclose($object_file);
}
