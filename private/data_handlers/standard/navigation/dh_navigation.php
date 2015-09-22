<?php
/**
 * @file
 * Providing navigation-related structures.
 */


// #############################################################################
// Prepare menus upon the data handler's inclusion.

$resource_loader_opts = array(
  'locale' => LOCALE_KEY,
);
apputils_wake_resource('definitions', 'menus', $resource_loader_opts);

// This function fills up the $temp array with the rendered menus, so that
// dh_navigation() will only have to fetch them from $temp and return them for
// their respective entities.
datautils_prepare_menus(
  $GLOBALS['config'],
  $GLOBALS['request'],
  $GLOBALS['definitions'],
  $GLOBALS['temp']
);


// #############################################################################
// Standard function.

function dh_navigation($args) {
  $output = '';

  if (!empty($GLOBALS['config']['ui']['enable_langswitchers'])
      && $args['order_id'] == 'main_menu') {
    apputils_wake_resource('data_handler', 'system_helpers');
    $order = array(
      'order_id' => 'language_switcher',
      // extra_attributes doesn't sound like a standard API implementation.
      'extra_attributes' => array(
        'class' => array('langswitch--nav'),
      ),
    );
    $output .= dh_system_helpers($order);
  }

  $output .= _fetch_menu_from_temp($args);
  return $output;
}

function _fetch_menu_from_temp($args) {
  if (!empty($GLOBALS['temp']['rendered_menus'][$args['order_id']])) {
    return $GLOBALS['temp']['rendered_menus'][$args['order_id']];
  }
  elseif (is_dev_mode('verbose')) {
    $message = "Note: dh_navigation couldn't find the ordered menu: <code>"
      . ensafe_string($args['order_id'], 'attribute_value') . '</code>.';
    sys_notify($message);
  }
}
