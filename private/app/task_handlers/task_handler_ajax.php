<?php
/**
 * @file
 * Task handler for task type 'ajax'.
 *
 * TODO.
 */

$header = $request['server_protocol'] . ' 403 Forbidden';
sys_notify('Unfinished feature.', 'warning');
apputils_exit_nicely($header);
