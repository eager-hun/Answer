<?php
/**
 * @file
 * Field handler for fields that want to show dynamically generated content.
 *
 * At the moment it seems that it just delegates the task to another
 * data_handler - the one defined among the metadata of the entity instance.
 */

// Standard function.
function dh_field_php($args) {
  // This function was called by _fetch_entity_raw().
  // It tells us which field told it to call this data_hander this time.
  $field_id = $args['field_id'];

  // _fetch_entity_raw() also passes for us the complete entity definition
  // of the entity who wants this field.
  $record   = $args['record'];

  // The entity definition holds which field with dynamic content wants their
  // content provided by which data_handler.
  $data_handler      = $record['meta']['data_handlers'][$field_id];
  $data_handler_func = 'dh_' . $data_handler;
  apputils_wake_resource('data_handler', $data_handler);

  // Here we copy the instructions that were assigned to the field definition,
  // so that we can pass it on to the actually content-serving data_handler.
  $instructions = $record['data'][$field_id];

  if (function_exists($data_handler_func)) {
    // dh_foo() functions will expect their first (and sometimes only) parameter
    // to be the 'args', then some may expect a second (though possibly
    // optional) 'opts' parameter too.
    if (!empty($instructions['opts'])) {
      $result = $data_handler_func($instructions['args'], $instructions['opts']);
    }
    else {
      $result = $data_handler_func($instructions['args']);
    }

    // The standard package format for returning field data.
    $output = array(
      'field_type'    => 'php',
      'field_label'   => $args['field_defs']['label'],
      'field_content' => $result,
    );
  }
  else {
    if (is_dev_mode()) {
      sys_notify('Error: unrecognized data handler function was suggested to php field handler.', 'warning');
    }
    $output = NULL;
  }

  return $output;
}
