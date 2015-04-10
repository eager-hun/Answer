<?php
/**
 * @file
 * Developer's blank canvas.
 *
 * TODO: first development task should be to put all 'devpages' projects into
 * their dedicated external file (or even, directory) - within this
 * data-handler's directory.
 * (An example might (or might not) be how dh_admin does it.)
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
 * Project 1.
 */
function _project_1($args) {
  return '<p>Project 1., hosted and provided by the <code>devpages</code> data handler.</p>';
}

