<?php
/**
 * @file
 * Custom entities to cater for developer needs.
 *
 * You can provide custom script for entities in separate files within this
 * directory.
 *
 * A twin sibling of this data handler (with a different name) planted into
 * data_handlers/custom/ could very well serve the need for further, custom
 * scripted entities.
 */


/**
 * Actions upon inclusion.
 */
$GLOBALS['temp']['dh_devel_entities'] = array();

/**
 * Standard function.
 */
function dh_devel_entities($args) {
  $file_name      = dirname(__FILE__) . '/dhde_'
                  . ensafe_string($args['order_id'], 'file_name') . '.php';
  $function_name  = 'devel_entities_' . $args['order_id'];

  if (file_exists($file_name)) {
    include_once($file_name);
  }
  if (function_exists($function_name)) {
    return $function_name($args);
  }
  elseif (is_dev_mode()) {
    sys_notify('Unrecognized task was encountered by dh_devel_entities.', 'warning');
    return FALSE;
  }
}
