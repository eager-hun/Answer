<?php
/**
 * @file
 * Custom entities to cater for developer needs.
 */


/**
 * Actions upon inclusion.
 */
$GLOBALS['temp']['dh_fpp_helper'] = array();

/**
 * Standard function.
 */
function dh_fpp_helper($args) {
  $file_name      = dirname(__FILE__) . '/dhfpp_'
                  . escape_value($args['order_id'], 'file_name') . '.php';
  $function_name  = 'fpp_' . $args['order_id'];

  if (file_exists($file_name)) {
    include_once($file_name);
  }
  if (function_exists($function_name)) {
    return $function_name($args);
  }
  elseif (is_dev_mode()) {
    sys_notify('Unrecognized task was encountered by dh_fpp_helper.', 'warning');
    return FALSE;
  }
}
