<?php
/**
 * @file
 * Content generator; to make developing a bit easier.
 */


/**
 * Standard function.
 */
function dh_content_generator($args) {
  $generator_defs = array(
    'entity' => array(
      'generic' => '10',
      'article' => '10',
    ),
  );

  _generate_content($generator_defs);
}


function _generate_content($defs) {
  if (is_dev_mode('verbose')) {
    $message = "Right now I don't have the time to create a content generator.";
    sys_notify($message, 'warning');
  }
}
