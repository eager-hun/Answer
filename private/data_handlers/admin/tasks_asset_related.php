<?php
/**
 * @file
 * Asset-related admin tasks.
 */


/**
 * Admin function for rebuilding path cache.
 */
function testing_uglifyjs() {
  _trigger_uglifyjs();
}

function _trigger_uglifyjs() {

  sys_notify('Development is currently being stuck on this.', 'warning');

  // See:
  // http://stackoverflow.com/questions/18896515/calling-node-and-uglifyjs-from-php-context
  // https://developers.google.com/closure/compiler/docs/gettingstarted_app

  // HOMEWORK: escapeshellarg()!

  // $response = array();
  // exec('node uglifyjs --version', $response);
  // $message = '<pre>' . implode('<br>', $response) . '</pre>';

  // $response = shell_exec('node uglifyjs --version');
  // $message = '<pre>' . $response . '</pre>';
  // sys_notify($message, 'debug');
}
