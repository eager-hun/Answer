<?php
/**
 * @file
 * index.php
 */

if (function_exists('xdebug_disable')) {
  xdebug_disable();
}

define('SCRIPT_ROOT', dirname(__FILE__) . '/');

require_once('director.php');
