<?php
/**
 * @file
 * App init.
 */


// #############################################################################
// Basic utilities.

/**
 * Base path.
 *
 * Returns the base path for the request's current locale, unless directly
 * instructed to return another locale's one.
 *
 * Tied to locale management, because the only implemented language negotiation
 * is done via looking at the domin name (subdomains).
 */
function base_path($options = array()) {
  global $config, $request;

  // For current installation, whichever it is.
  if (empty($options['environment'])) {
    if (empty($options['for_locale'])) {
      $domain = $request['domain'];
    }
    else {
      $domain = ensafe_string($config['env']['domain']['locale'][$options['for_locale']], 'domain');
    }
  }
  // Return domain names for a specified environment.
  else {
    if (empty($options['for_locale'])) {
      $domain = ensafe_string(
        $config['presets'][$options['environment']]['domain'][LOCALE_KEY],
        'domain'
      );
    }
    else {
      $domain = ensafe_string(
        $config['presets'][$options['environment']]['domain'][$options['for_locale']],
        'domain'
      );
    }
  }
  if (empty($config['env']['working_dir'])) {
    $output = ensafe_string($config['env']['http_protocol'], 'attribute_value')
      . '://' . $domain . '/';
  }
  else {
    $output = ensafe_string($config['env']['http_protocol'], 'attribute_value')
      . '://' . $domain . '/'
      . ensafe_string($config['env']['working_dir'], 'path_fragment')
      . '/';
  }
  return $output;
}

/**
 * Recording system messages upon script-time to be printed out in the template.
 *
 * @global array $sys_notifications_pool
 * @param string $message
 * @param string $severity
 *   Optional.
 *   Valid values are 'info' || 'warning' || 'alert' || 'debug'.
 *   Defaults to 'info'.
 */
function sys_notify($message, $severity = 'info') {
  global $sys_notifications_pool;
  $sys_notifications_pool[$severity][] = $message;
}

/**
 * Collecting and presenting accumulated system messages.
 *
 * Wow, what is this. (Main part of this code is brought over from 2012.)
 */
function process_sys_notifications(&$sys_notifications_pool, $severity_level = '') {
  $output = '';
  $log_msg = '';
  if (!empty($sys_notifications_pool)) {
    if (empty($severity_level)) {
      $output .= '<div class="messages-container">';
      // Go through all of them.
      if (!empty($sys_notifications_pool['alert'])) {
        array_walk($sys_notifications_pool['alert'], 'ensafe_array_vals', 'html');
        $alert_messages = implode("</li>\n  <li>", $sys_notifications_pool['alert']);
        $output  .= "\n<div class=\"messages alert\"><ul>\n  <li>";
        $output  .= $alert_messages;
        $output  .= "</li>\n</ul></div>";
      }
      if (!empty($sys_notifications_pool['warning'])) {
        array_walk($sys_notifications_pool['warning'], 'ensafe_array_vals', 'html');
        $warning_messages = implode("</li>\n  <li>", $sys_notifications_pool['warning']);
        $output  .= "\n<div class=\"messages warning\"><ul>\n  <li>";
        $output  .= $warning_messages;
        $output  .= "</li>\n</ul></div>";
      }
      if (!empty($sys_notifications_pool['info'])) {
        array_walk($sys_notifications_pool['info'], 'ensafe_array_vals', 'html');
        $info_messages = implode("</li>\n  <li>", $sys_notifications_pool['info']);
        $output  .= "\n<div class=\"messages info\"><ul>\n  <li>";
        $output  .= $info_messages;
        $output  .= "</li>\n</ul></div>";
      }
      if (!empty($sys_notifications_pool['debug'])) {
        array_walk($sys_notifications_pool['debug'], 'ensafe_array_vals', 'html');
        $debug_messages = implode("</li>\n  <li>", $sys_notifications_pool['debug']);
        $output  .= "\n<div class=\"messages debug\"><ul>\n  <li>";
        $output  .= $debug_messages;
        $output  .= "</li>\n</ul></div>";
      }
      $output .= "\n</div><!-- /.messages-container -->\n";
      // Resetting the notifications pool in order to avoid duplicate printouts
      // in cases where the notifications are being audited repeatedly in the
      // script.
      $sys_notifications_pool = array();
    }
    // If the desired severity level was passed in as argument, do only that one.
    elseif (!empty($severity_level) && !empty($sys_notifications_pool[$severity_level])) {
      array_walk($sys_notifications_pool[$severity_level], 'ensafe_array_vals', 'html');
      $messages = implode("</li>\n  <li>", $sys_notifications_pool[$severity_level]);

      $output .= '<div class="messages-container">';
      $output  .= "\n<div class=\"messages "
        . ensafe_string($severity_level, 'attribute_value') . "\"><ul>\n  <li>";
      $output  .= $messages;
      $output  .= "</li>\n</ul></div>";
      $output .= "\n</div><!-- /.messages-container -->\n";
      // Resetting the notifications pool in order to avoid duplicate printouts
      // in cases where the notifications are being audited repeatedly in the
      // script.
      $sys_notifications_pool[$severity_level] = array();
    }

    return $output;
  }
}

/**
 * Exit nicely.
 *
 * Prints the sys_notifications collected so far, ensures an HTTP header of
 * ERROR level, then exits.
 */
function apputils_exit_nicely($header = '') {
  global $request, $sys_notifications_pool;

  if (empty($header) && !empty($request['server_protocol'])) {
    header($request['server_protocol'] . ' 500 (script failed)');
  }
  else {
    header($header);
  }
  $output = process_sys_notifications($sys_notifications_pool);
  print $output;
  exit;
}

/**
 * Printing variables on screeen (for dev).
 */
function show($variable_name) {
  ob_start();
  if (!empty($GLOBALS[$variable_name])) {
    print_r($GLOBALS[$variable_name]);
  }
  elseif (defined($variable_name)) {
    print constant($variable_name);
  }
  else {
    print 'Either no such is defined, or is empty(), IDK yet. FIXME.';
  }
  $data = ob_get_clean();
  $message = '<pre class="devel">----> ' . strtoupper($variable_name) . ":\n\n"
    . htmlentities($data, ENT_QUOTES, 'UTF-8') . '</pre>';
  sys_notify($message, 'debug');
}

/**
 * Dev mode check shorthand.
 *
 * @param string $level
 *   Optional. Recognized values: on || verbose.
 */
function is_dev_mode($level = '') {
  if (!empty($level) && $level == 'verbose') {
    // NOTE: needs typesafe comparison operator, as the disabled dev_mode is
    // represented by 0 as value here, and - in php - one shouldn't rely on
    // the results of simple comparisons between integer vs string.
    if ($GLOBALS['config']['app']['dev_mode'] === 'verbose') {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
  else {
    if (!empty($GLOBALS['config']['app']['dev_mode'])) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
}

/**
 * Loading resources on demand.
 *
 * ("Class loader" for those who find the topic too difficult at the moment.)
 */
function apputils_wake_resource($resource_type, $resource_id, $options = array()) {
  global $config, $registry, $definitions, $temp, $datapool;

  if ($resource_type == 'class') {
    if (!in_array($resource_id, $temp['initiated_resources']['classes'])) {
      if (!empty($config['app']['dependencies'][$resource_id])) {
        $class = $config['app']['dependencies'][$resource_id];
        if (file_exists($class)) {
          require_once($class);
          $temp['dependencies']['met'][] = $resource_id;
          // We store its id in the initiated array, so it won't be loaded any more.
          $temp['initiated_resources']['classes'][] = $resource_id;
        }
        else {
          _loader_failure($resource_type, $resource_id);
        }
      }
      // Post-load actions.
      if ($resource_id == 'htmlpurifier') {
        if (in_array($resource_id, $temp['dependencies']['met'])) {
          _init_purifier();
        }
        else {
          if (!in_array('dependency_htmlpurifier', $config['app']['suppress_warnings'])) {
            $message = "Missing the dependency _htmlpurifier_ can lead to trouble: everyone can get hacked. (Consult your config file's _Dependencies_ section.)";
            sys_notify($message, 'warning');
          }
          // We store its id in the initiated array, so it won't be loaded any more.
          $temp['initiated_resources']['classes'][] = $resource_id;
        }
      }
      if ($resource_id == 'php-markdown' && !in_array($resource_id, $temp['dependencies']['met'])) {
        if (!in_array('dependency_php-markdown', $config['app']['suppress_warnings'])) {
          $message = "Missing the dependency _php-markdown_ imposes inconvenience: texts might look really ugly. (Consult your config file's _Dependencies_ section.)";
          sys_notify($message, 'warning');
          // We store its id in the initiated array, so it won't be loaded any more.
          $temp['initiated_resources']['classes'][] = $resource_id;
        }
      }
    }
  }
  elseif ($resource_type == 'definitions') {
    if (!in_array($resource_id, $temp['initiated_resources']['definitions'])) {
      if (!empty($options['locale'])) {
        $resource_file = $registry['app_current']['definitions']
          . '/definitions_' . $resource_id . '_' . $options['locale']
          . '_locale.php';
      }
      else {
        $resource_file = $registry['app_current']['definitions']
          . '/definitions_' . $resource_id . '.php';
      }
      if (file_exists($resource_file)) {
        require_once($resource_file);
        // We copy over the array from the included file to the global
        // $definitions array so everyone can see it.
        $definitions[$resource_id] = ${$resource_id};
        unset(${$resource_id}); // Freeing memory.
        // We store its id in the initiated array, so it won't be loaded any more.
        $temp['initiated_resources']['definitions'][] = $resource_id;
      }
      else {
        _loader_failure($resource_type, $resource_id);
      }
    }
  }
  elseif ($resource_type == 'data_handler') {
    if (!in_array($resource_id, $temp['initiated_resources']['data_handler'])) {

      // We have no registry of data handlers. So first we look for a data
      // handler among the standard ones, and if it's not there, then among the
      // custom ones. Cheap.
      // This implies that you cannot have a custom data handler with a name
      // that's identical to one among the standard ones. Room to improve.
      $resource_file_standard = $registry['app_internals']['data_handlers']
        . '/standard/' . $resource_id . '/dh_' . $resource_id . '.php';
      $resource_file_custom = $registry['app_internals']['data_handlers']
        . '/custom/' . $resource_id . '/dh_' . $resource_id . '.php';

      if (file_exists($resource_file_standard)) {
        require_once($resource_file_standard);
        // We store its id in the initiated array, so it won't be loaded any more.
        $temp['initiated_resources']['data_handler'][] = $resource_id;
      }
      elseif (file_exists($resource_file_custom)) {
        require_once($resource_file_custom);
        // We store its id in the initiated array, so it won't be loaded any more.
        $temp['initiated_resources']['data_handler'][] = $resource_id;
      }
      else {
        _loader_failure($resource_type, $resource_id);
      }
    }
  }
  elseif ($resource_type == 'permanent_data_storage') {
    if (!in_array($resource_id, $temp['initiated_resources']['permanent_data_storage'])) {
      $resource_file =
        $registry['app_current']['storage'] . '/records_' . $resource_id . '.php';
      if (file_exists($resource_file)) {
        require_once($resource_file);
        // We copy over the array from the included file to the global $datapool
        // array so everyone can see it.
        $datapool['permanent_data_storage'][$resource_id] = ${$resource_id};
        unset(${$resource_id}); // Freeing memory.
        // We store its id in the initiated array, so it won't be loaded any more.
        $temp['initiated_resources']['permanent_data_storage'][] = $resource_id;
      }
      else {
        sys_notify("The specified data storage doesn't exist", 'warning');
        _loader_failure($resource_type, $resource_id);
      }
    }
  }
  elseif ($resource_type == 'presentation_agent') {
    if (!in_array($resource_id, $temp['initiated_resources']['presentation_agent'])) {
      $resource_file = $registry['app_current']['presentation_agents']
        . '/pa_' . $resource_id . '.php';
      if (file_exists($resource_file)) {
        require_once($resource_file);
        // We store its id in the initiated array, so it won't be loaded any more.
        $temp['initiated_resources']['presentation_agent'][] = $resource_id;
      }
      else {
        _loader_failure($resource_type, $resource_id);
      }
    }
  }
  elseif ($resource_type == 'layout') {
    if (!in_array($resource_id, $temp['initiated_resources']['layout'])) {
      $resource_file = $registry['app_current']['templates'] . '/layouts/'
        . $resource_id . '/' . $resource_id . '.php';
      if (file_exists($resource_file)) {
        require_once($resource_file);
        // We store its id in the initiated array, so it won't be loaded any more.
        $temp['initiated_resources']['layout'][] = $resource_id;
      }
      else {
        _loader_failure($resource_type, $resource_id);
      }
    }
  }
  else {
    if (is_dev_mode()) {
      $message = 'Unknown resource type has been passed to resource loader: <em>'
        . ensafe_string($resource_type, 'attribute_value') . '</em>.';
    }
    else {
      $message = 'Unknown resource type has been passed to resource loader.';
    }
    sys_notify($message, 'warning');
  }
}

function _loader_failure($resource_type, $resource_id) {
  if (is_dev_mode()) {
    $message = 'Error: resource <em>'
      . ensafe_string($resource_id, 'attribute_value')
      . '</em> of type <em>'
      . ensafe_string($resource_type, 'attribute_value')
      . '</em> was not found.';
  }
  else {
    $message = 'Error: an internal resource was not found. Dev mode may have more info.';
  }
  sys_notify($message, 'warning');
}

/**
 * HTMLpurifier init for the wake_resource function.
 *
 * @see
 * http://htmlpurifier.org/docs
 * http://htmlpurifier.org/docs/enduser-customize.html
 * http://htmlpurifier.org/docs/enduser-customize.html#optimized
 * http://htmlpurifier.org/docs/enduser-id.html
 */
function _init_purifier() {
  $appconfig_purifier = $GLOBALS['config']['htmlpurifier'];
  $id_prefix = ensafe_string($appconfig_purifier['id_prefix'], 'attribute_value');

  $purifier_config = HTMLPurifier_Config::createDefault();
  $purifier_config->set('HTML.DefinitionID', 'answer-project-setup');
  $purifier_config->set('HTML.DefinitionRev', 1); // Cache-busting of a sort.
  // $purifier_config->set('Cache.DefinitionImpl', null); // Only while dev!
  $purifier_config->set('Attr.EnableID', true);
  $purifier_config->set('Attr.IDPrefix', $id_prefix);
  if ($def = $purifier_config->maybeGetRawHTMLDefinition()) {
    $def->addAttribute('div', 'data-purify-test', 'Enum#foo,bar');
    $def->addAttribute('div', 'data-cols', 'Number');
    $section = $def->addElement(
      'section',  // Name.
      'Block',    // Content set.
      'Flow',     // Allowed children.
      'Common'    // Attribute collection.
    );
  }
  $GLOBALS['purifier'] = new HTMLPurifier($purifier_config);
}

/**
 * File get contents.
 */
function apputils_read_file($args) {
  // Do we really need such? We shall see.
}

/**
 * Writing files on disk.
 */
function apputils_write_file($args) {
  // Do we really need such? We shall see.
}

/**
 * Script diagnostics.
 */
function apputils_script_diagnostics() {
  $output  = "\n<pre>\n";

  if (array_key_exists('REQUEST_TIME_FLOAT', $_SERVER)) {
    $time = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
    $output .= 'script time: ' . round($time, 2) . " sec\n";
  }
  $mem_peak = memory_get_peak_usage(true) / 1048576; // I wanna see MBs.

  $output .= 'peak memory: ' . round($mem_peak, 2) . " MB\n";
  $output .= "</pre>\n";
  return $output;
}

/**
 * Disable HTMLpurifier while working on things.
 *
 * This must be called after the HTMLpurifier dependency was set up in the
 * config (this just overrides those values).
 *
 * Integrated safety measure is that it only works in dev_mode.
 */
function apputils_disable_htmlpurifier() {
  if (is_dev_mode()) {
    $GLOBALS['config']['app']['dependencies']['htmlpurifier'] = FALSE;
    $GLOBALS['config']['app']['suppress_warnings'][] = 'dependency_htmlpurifier';
  }
}

/**
 * Explore undocumented APIs, tool_No 1: audit a function's arguments.
 *
 * NOTE: this is only for developer usage, obviously.
 *
 * It was created for finding out what kind of args ever make it into
 * templating-related functions - some of whom can end up inside beasts of
 * recursive sequences.
 *
 * Usage: drop it inside the inspected func:
 *
 * @code
 *
 * apputils_explore_arguments($args, $output = 'keys');
 *
 * @endcode
 *
 * To see the results, do var_dump($temp['arguments_explorer']); near the end
 * of director.php.
 */
function apputils_explore_arguments($args_to_inspect, $output = 'keys') {
  if (!is_dev_mode()) {
    return;
  }

  static $argsexp_inspect_id = 0;

  $call_id = '# ' . $argsexp_inspect_id;
  if (!array_key_exists('arguments_explorer', $GLOBALS['temp'])) {
    $GLOBALS['temp']['arguments_explorer'] = array();
  }
  $call_trace = debug_backtrace();
  $inspected_function = $call_trace[1]['function'];
  if (!array_key_exists($inspected_function, $GLOBALS['temp']['arguments_explorer'])) {
    $GLOBALS['temp']['arguments_explorer'][$inspected_function] = array();
  }
  $GLOBALS['temp']['arguments_explorer'][$inspected_function][$call_id] = array(
    'caller' => $call_trace[2]['function'],
    'args' => array(),
  );
  if ($output == 'full') {
    $GLOBALS['temp']['arguments_explorer'][$inspected_function][$call_id]['args'] =
      $args_to_inspect;
  }
  else {
    $GLOBALS['temp']['arguments_explorer'][$inspected_function][$call_id]['args'] =
      array_keys($args_to_inspect);
  }

  $argsexp_inspect_id++;
}
