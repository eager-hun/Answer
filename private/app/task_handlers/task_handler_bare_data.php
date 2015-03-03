<?php
/**
 * @file
 * Task handler for task type bare-data.
 */


if (empty($config['app']['serve_bare_data'])) {
  $header = $request['server_protocol'] . ' 403 Forbidden';
  sys_notify('Forbidden.', 'warning');
  apputils_exit_nicely($header);
}

if (!empty($request['get_data']['data_type'])
    && array_key_exists('instance_id', $request['get_data'])) {

  $data_type   = $request['get_data']['data_type'];
  $instance_id = $request['get_data']['instance_id'];

  if ($data_type == 'binder') {
    // Grabbing binder definitions.
    apputils_wake_resource('definitions', 'binders');
  }

  // Fetching data.
  $fetcher_args = array(
    'data_requestor' => 'bare_data', // Indicate the current task handler.
    'data_type'      => $data_type,
    'instance_id'    => $instance_id,
  );
  // Adding more arguments to the fetcher.
  if (!empty($request['get_data']['entity_type'])) {
    $fetcher_args['entity_type'] = $request['get_data']['entity_type'];
  }
  // Fetching data.
  datautils_data_fetcher($fetcher_args);

  // If result doesn't seem OK.
  if ($temp['data_statuses'][$instance_id] != '200') {
    if ($temp['data_statuses'][$instance_id] == '403') {
      // Other error states emitted a notification, but 403 was silent, so
      // now supplementing.
      sys_notify('Forbidden.');
    }
    $header = $request['server_protocol'] . ' '
      . ensafe_string($temp['data_statuses'][$instance_id], 'http_status');
    header($header);
    $response = process_sys_notifications($sys_notifications_pool);
  }
  // If result seems OK.
  else {
    // Providing input for the renderer utilities.
    $presenter_args = array();
    if (!empty($request['get_data']['output_type'])) {
      $presenter_args['output_type'] = $request['get_data']['output_type'];
    }
    if (!empty($request['get_data']['present_as'])) {
      $presenter_args['present_as'] = $request['get_data']['present_as'];
    }
    else {
      $presenter_args['present_as'] = 'automatic_inventory';
    }
    // Let dresser have all the info we have so far.
    $dresser_args = array_merge_recursive($fetcher_args, $presenter_args);
    // data_dresser() will call present() and return the rendered item.
    $response = templateutils_data_dresser($dresser_args);
  }
}
else {
  $header = $request['server_protocol'] . ' 400 Bad request';
  header($header);
  sys_notify('Insufficient request data.', 'warning');
  $response = process_sys_notifications($sys_notifications_pool);
}


// #############################################################################
// Sending response.

datautils_send_standard_headers($request);
$response = process_sys_notifications($sys_notifications_pool) . $response;
if (!empty($response)) {
  print $response;
}
