<?php
/**
 * @file
 * Custom entities for anything.
 *
 * You can provide custom script for entities in separate files within this
 * directory.
 */

/**
 * Standard function.
 */
function dh_custom_entities($args) {
  $file_name      = dirname(__FILE__) . '/custom_entities_'
                  . ensafe_string($args['order_id'], 'file_name') . '.php';
  $function_name  = 'custom_entities_' . $args['order_id'];

  if (file_exists($file_name)) {
    include_once($file_name);
  }
  if (function_exists($function_name)) {
    return $function_name($args);
  }
  elseif (is_dev_mode()) {
    sys_notify('Unrecognized task was encountered by dh_custom_entities.', 'warning');
    return FALSE;
  }
}


