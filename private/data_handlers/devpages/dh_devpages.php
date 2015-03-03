<?php
/**
 * @file
 * Developer's blank canvas.
 *
 * TODO: first development task should be to put all 'devpages' entities into
 * their dedicated external file - within this data-handler's directory.
 * (An example could be how dh_admin does it.)
 */

/**
 * Standard function.
 */
function dh_devpages($args) {
  if (is_dev_mode()) {
    $function = '_' . $args['order_id'];
    if (function_exists($function)) {
      // TODO: these things should be included from separate files.
      return $function($args);
    }
    elseif (is_dev_mode()) {
      sys_notify('Unrecognized task was encountered by dh_devpages.', 'warning');
      return FALSE;
    }
  }
  else {
    sys_notify('Note: <em>devpages<em> works only in dev_mode');
  }
}

/**
 * Blank sheet.
 */
function _blank_sheet($args) {
  return '<p>This content is being provided by the <code>devpages</code> data handler.</p><p>Come and swap it with something more useful.</p>';
}

