<?php
/**
 * @file
 * Admin interface provider.
 *
 * Very rough, hurried approach.
 */

/**
 * Standard function.
 */
function dh_admin($args) {
  global $registry, $request;

  // Authorizaton check.
  // @see also the "security" component!
  if (!is_admin($GLOBALS['config'])) {
    $header = $request['server_protocol'] . " 403 Forbidden";
    sys_notify(loc('http-403'), 'warning');
    datautils_send_standard_headers($request);
    apputils_exit_nicely($header);
  }

  $admin_tasks = array();
  _define_admin_tasks($admin_tasks);

  // If we are requested to do something, let's do that.
  if (!empty($request['get_data']['task'])
      && array_key_exists($request['get_data']['task'], $admin_tasks)) {

    $current_task = $request['get_data']['task'];
    $task_file = $registry['app_internals']['data_handlers'] . '/admin/'
      . $admin_tasks[$current_task]['include'] . '.php';
    if (file_exists($task_file)) {
      include_once($task_file);
    }
    if (function_exists($admin_tasks[$current_task]['function'])) {
      $admin_tasks[$current_task]['function']();
    }
    else {
      $message = 'Could not find the function for the requested admin task.';
      sys_notify($message, 'warning');
    }
  }
  elseif (!empty($request['get_data']['task'])) {
    $message = 'Could not find the definition for the requested admin task.';
    sys_notify($message, 'warning');
  }

  // If the reqest was satisfied, it should have notified the administrator via
  // sys notify. Now the admin can get the task-links again to be able to chose
  // another task.
  return _admin_links($admin_tasks);
}

function _define_admin_tasks(&$admin_tasks) {
  $admin_tasks['rebuild_path_cache'] = array(
    'function'   => 'rebuild_path_cache',
    'include'    => 'tasks_path_related',
    'human_name' => array(
      'primary'   => 'Rebuild path cache',
      'secondary' => 'Webcím-útvonalak gyorstárának újraépítése',
    ),
  );
  $admin_tasks['regenerate_xml_sitemaps'] = array(
    'function'   => 'regenerate_xml_sitemaps',
    'include'    => 'tasks_path_related',
    'human_name' => array(
      'primary'   => 'Rebuild XML sitemaps',
      'secondary' => 'XML webhelytérképek újraépítése',
    ),
  );
  $admin_tasks['regenerate_theme_registry'] = array(
    'function'   => 'rebuild_theme_registry',
    'include'    => 'tasks_theme_related',
    'human_name' => array(
      'primary'   => 'Rebuild theme registry',
      'secondary' => 'Vizuális sablon regisztrációs adatbázisának újraépítése',
    ),
  );
  // $admin_tasks['asset-manipulations'] = array(
  //   'function'   => 'testing_uglifyjs',
  //   'include'    => 'tasks_asset_related',
  //   'human_name' => array(
  //     'primary'   => 'uglify.js experiment',
  //     'secondary' => 'uglify.js kísérlet',
  //   ),
  // );
}

function _admin_links($admin_tasks) {
  $output = "<ul class='admin-tasks'>\n";
  foreach ($admin_tasks as $task_id => $task_data) {
    $link_attributes = array(
      'href' => base_path()
        . ensafe_string($GLOBALS['config']['app']['admin_path'], 'path_fragment')
        . '?task=' . ensafe_string($task_id, 'attribute_value'),
    );
    $link_text =
      ensafe_string($task_data['human_name'][LOCALE_KEY]);
    $args = array(
      'variables' => array(
        'link_attributes' => templateutils_render_html_attributes($link_attributes),
        'link_text' => $link_text,
      ),
    );
    $output .= '<li>' . draw_link($args) . "</li>\n";
  }
  $output .= "</ul>\n";
  return $output;
}
