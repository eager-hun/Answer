<?php
/**
 * @file
 * Definitions for security measures.
 *
 * Homework:
 * http://stackoverflow.com/questions/3126072/what-are-the-best-php-input-sanitizing-functions#answer-3126175
 * https://www.inanimatt.com/php-input-filtering.html
 * https://www.inanimatt.com/php-output-escaping.html
 */


/**
 * Distrusting inputs. FIXME.
 *
 * Procedures here that are appearing to be over-cautious were motivated by
 * SQL injection-, ShellShock- and RFD type exploits, where input strings
 * contain such substrings that the whole hosting infrastructure is unaware of
 * or mis-handles.
 *
 * Inputs to distrust so far:
 * server_protocol
 * http_host
 * request_uri
 * $_post
 * $_get
 */
function distrust_input($input, $from) {
  global $config, $request;

  if ($from == 'server_protocol') {
    // We will be over-cautious with the protocol because the very string we
    // conclude in here may be returned in a series of HTTP response headers.
    // If I knew anything about servers, things around here could make more
    // sense.
    // These might be of help:
    // http://stackoverflow.com/questions/4503135/php-get-site-url-protocol-http-vs-https
    // http://stackoverflow.com/questions/16825243/why-is-phps-server-protocol-showing-http-1-1-even-when-using-https
    // http://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    if (strpos($input, '1.0') !== FALSE) {
      $version = '1.0';
    }
    elseif (strpos($input, '1.1') !== FALSE) {
      $version = '1.1';
    }
    elseif (strpos($input, '2.0') !== FALSE) {
      $version = '2.0';
    }
    else {
      sys_notify("Error: distrust_input() couldn't determine the server_protocol version.", 'warning');
      apputils_exit_nicely();
    }
    $protocol = 'HTTP';
    // This return data is now supposed to be a safe string.
    return $protocol . '/' . $version;
  }
  elseif ($from == 'http_host') {
    // We will only use the incoming data to sample it for a search in our own
    // config. The value we return for the rest of the system to work with,
    // will eventually originate from our own config data.
    // Also see:
    // http://shiflett.org/blog/2006/mar/server-name-versus-http-host
    // http://stackoverflow.com/questions/1459739/php-serverhttp-host-vs-serverserver-name-am-i-understanding-the-ma
    if (!empty($config['env']['domain']['locale'])
        || !is_array($config['env']['domain']['locale'])) {
      $domain_index = array_search($input, $config['env']['domain']['locale']);
      if ($domain_index !== FALSE) {
        // The resulting string is coming from our own $config array.
        return ensafe_string($config['env']['domain']['locale'][$domain_index], 'domain');
      }
      else {
        sys_notify("Unrecognized domain name. (Consult your config file's _Config presets_ section.)", 'warning');
        if (!empty($request['server_protocol'])) {
          $header = $request['server_protocol'] . ' 400 Bad request';
          apputils_exit_nicely($header);
        }
        else {
          sys_notify('Like, nothing worked.', 'alert');
          apputils_exit_nicely();
        }
      }
    }
    else {
      sys_notify('Error: distrust_input() has encountered an insufficient domain config.', 'alert');
      apputils_exit_nicely();
    }
  }
  elseif ($from == 'request_uri') {
    return filter_var($input, FILTER_SANITIZE_URL);
  }
  elseif ($from == '$_post') {
    // All things get pretty much planed down in it... Not very real-life-like...
    array_walk($input, 'ensafe_array_vals', 'post_value');
    return $input;
  }
  elseif ($from == '$_get') {
    // All things get pretty much planed down in it... Not very real-life-like...
    array_walk($input, 'ensafe_array_vals', 'get_value');
    return $input;
  }
  else {
    sys_notify('distrust_input() did not understand where the passed-in input originated from!', 'warning');
    return '';
  }
}

/**
 * Ensafe string. FIXME.
 */
function ensafe_string($string, $usage = 'display') {
  switch ($usage) {
    case 'html':
      apputils_wake_resource('class', 'htmlpurifier');
      if (!empty($GLOBALS['purifier'])) {
        $processed = $GLOBALS['purifier']->purify($string);
      }
      else {
        // WARNING:
        // So the bizarre situation is that we cannot sys_notify() here about
        // the lack of the htmlpurifier lib, because the sys_notify() output
        // also wants to be sanitized by this codeblock, which means an infinite
        // loop.
        // NOTE: apputils_wake_resource() should already have made sure that
        // a notification about the risks were issued.
        if (!empty($GLOBALS['config']['app']['give_up_security'])
            && $GLOBALS['config']['app']['give_up_security'] === 1) {
          // You can get unescaped HTML output only if you explicitly disabled
          // security.
          $processed = $string;
        }
        else {
          $processed = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
        }
      }
      break;
    case 'domain':
      $processed = preg_replace('#[^-_\.a-z0-9]#', '', $string);
      break;
    case 'post_value':
      // Make me not have to do these senseless things.
      $processed = preg_replace('#[^-_a-z0-9]#', '', trim($string));
      break;
    case 'get_value':
      // Make me not have to do these senseless things.
      $processed = preg_replace('#[^-_a-z0-9]#', '', trim($string));
      break;
    case 'href':
      $processed = filter_var($string, FILTER_SANITIZE_URL);
      break;
    case 'file_name':
      $processed = preg_replace('#[^-_\.a-z0-9]#', '', $string);
      break;
    case 'path_fragment':
      // NOTE: don't allow upwards traversing.
      $processed = preg_replace('#[^-_\.a-z0-9/]|[\.]{2}#', '', $string);
      break;
    case 'path_with_file_name':
      // NOTE: don't allow upwards traversing.
      $processed = preg_replace('#[^-_\.a-z0-9/]|[\.]{2}#', '', $string);
      break;
    case 'attribute_name':
      $processed = preg_replace('#[^-_a-z0-9]#', '', $string);
      break;
    case 'attribute_value':
      $processed = preg_replace('#[^-_a-z0-9]#', '', $string);
      break;
    case 'http_status':
      $processed = preg_replace('#[^-_a-z0-9/]#', '', $string);
      break;
    case 'css':
      // WARNING!
      // Bear in mind that CSS seems to be among the most unsafe things ever.
      // See:
      // http://stackoverflow.com/questions/3241616/sanitize-user-defined-css-in-php#answer-5209050
      // This regexp gets CSS commens and newlines out.
      $processed = preg_replace('#\/\*(.+?)\*\/|\r?\n|\r#s', '', $string);
      break;
    // Default is same as 'display'.
    default:
      // Warning about typos or wrong usage.
      if (!empty($usage) && $usage !== 'display') {
        $message = 'Warning: unrecognized ensafe_string() argument <em>'
          . ensafe_string($usage) . '</em>. See ensafe_string() function '
          . 'declaration for more info.';
        sys_notify($message, 'alert');
      }
      // If no argument was supplied, or it was 'display'.
      $processed = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
      break;
  }

  return $processed;
}

/**
 * Helper: escaping strings in an array. Implemented as array_walk() callback.
 *
 * @param string $usage
 *   Optional. Defaults to 'attribute'. Valid values are ensafe_string()'s
 *   parameters.
 */
function ensafe_array_vals(&$val, $key, $usage = 'attribute_value') {
  $val = ensafe_string($val, $usage);
}

/**
 * Is admin?
 *
 * @ingroup not_sophisticated
 *
 * @see notes in config.php's corresponding section.
 *
 * FIXME one day.
 */
function is_admin() {
  if (array_key_exists('admin_mode', $GLOBALS['config']['app'])) {
    if ($GLOBALS['config']['app']['admin_mode'] === 1) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }
  else {
    return FALSE;
  }
}

/**
 * In-app security policies.
 */
function implement_security_policies() {
  // The script should only run if the config presets are used in the standard
  // way.
  if (!defined('CONFIG_PRESET')
      || empty($GLOBALS['config']['presets'][CONFIG_PRESET])) {
    sys_notify('Improper usage of script.', 'alert');
    apputils_exit_nicely();
  }

  if (is_dev_mode()) {
    error_reporting(E_ALL);

    // Warning about enabled dev_mode on public instances.
    if (CONFIG_PRESET == 'stage' || CONFIG_PRESET == 'live') {
      sys_notify('Warning: a configuration conflict was detected.', 'warning');
    }
  }
  else {
    error_reporting(0);
  }

  // Warning about enabled admin_mode on public instances.
  if (is_admin() && (CONFIG_PRESET == 'stage' || CONFIG_PRESET == 'live')) {
    sys_notify('Warning: a configuration conflict was detected.', 'warning');
  }
}
