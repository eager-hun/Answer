<?php
/**
 * @file
 * Orientation.
 */


// #############################################################################
// Server protocol.

$request['server_protocol'] =
  distrust_input($_SERVER['SERVER_PROTOCOL'], 'server_protocol');


// #############################################################################
// Setting locale by looking at the HOST.

$request['domain'] = distrust_input($_SERVER['HTTP_HOST'], 'http_host');

$request['locale']['key'] =
  array_search($request['domain'], $config['env']['domain']['locale']);
if (empty($request['locale']['key'])) {
  $message = 'Warning: problems in orientation stage: <em>locale key</em> could not be established.';
  sys_notify($message, 'warning');
  apputils_exit_nicely();
}
$request['locale']['langcode'] =
  $config['document']['locale'][$request['locale']['key']]['langcode'];
$request['locale']['key'] =
  escape_value($request['locale']['key'], 'attribute_value');

// Constants for convenience.
define('LOCALE_KEY', $request['locale']['key']);
define('LOCALE_ID', 'locale_' . $request['locale']['key']);

$locale_for_php =
  $config['document']['locale'][LOCALE_KEY]['php_locale'];
// FIXME: But does this work?
setlocale(LC_TIME, $locale_for_php);


// #############################################################################
// Finding out desired task by looking at the URI.

$request['uri_string'] = distrust_input($_SERVER["REQUEST_URI"], 'request_uri');
$request['post_data'] = distrust_input($_POST, '$_post');

// With no arguments given at all, we serve the homepage.
if (empty($request['uri_string'])) {
  $request['task']['type'] = 'page';
  $request['page_id'] = 'home';
}
else {
  $request['get_data'] = distrust_input($_GET, '$_get');
  $request['uri_path'] = ltrim(strtok($request['uri_string'], '?'), '/');

  if (!empty($request['uri_path'])) {
    $request['uri_path_items'] = explode('/', $request['uri_path']);

    if (!empty($config['env']['working_dir'])) {
      $working_dir_items = explode('/', $config['env']['working_dir']);
      $pivotal_key = count($working_dir_items);
      $special_task =
        array_search($request['uri_path_items'][$pivotal_key], $config['app']['reserved_paths']);
    }
    else {
      $special_task =
        array_search($request['uri_path_items'][0] ,$config['app']['reserved_paths']);
    }
    if ($special_task !== FALSE) {
      $request['task']['type'] = $special_task;
    }
    else {
      $request['task']['type'] = 'page';
      if (!empty($config['env']['working_dir'])) {
        $home_path = $config['env']['working_dir'] . '/';
        if ($request['uri_path'] == $home_path) {
          $request['task']['type'] = 'page';
          $request['page_id'] = 'home';
        }
        // Else the page_id will be identified later on.
      }
      // And the page_id will be identified later on.
    }
  }
  // No path given in the URI, so homepage gets served.
  else {
    $request['task']['type'] = 'page';
    $request['page_id'] = 'home';
  }
}

