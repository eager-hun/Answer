<?php
/**
 * @file
 * Field handler for fields with dynamically generated content.
 *
 * At the moment it seems that it just delegates the task to another
 * data-handler - the one defined among the metadata of the entity instance.
 */

// Standard function.
function dh_field_php($args) {

  // ###########################################################################
  // Fetching data.

  $field_id = $args['field_id'];
  $record   = $args['record'];

  $data_handler      = $record['meta']['data_handlers'][$field_id];
  $data_handler_func = 'dh_' . $data_handler;
  apputils_wake_resource('data_handler', $data_handler);

  $contractor_args = $record['data'][$field_id];

  if (function_exists($data_handler_func)) {
    $result = $data_handler_func($contractor_args);
  }
  elseif (is_dev_mode()) {
    sys_notify('Unrecognized data handler function was suggested to php field handler.', 'warning');
  }

  $output = array(
    'field_type'    => 'php',
    'field_label'   => $args['field_defs']['label'],
    'field_content' => $result,
  );
  return $output;
}
