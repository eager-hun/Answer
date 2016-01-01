<?php
/**
 * @file
 * Field handler for text type fields.
 *
 * Currently it reads and processes the targeted fields' content, then returns
 * it according to the specified discipline.
 */

// Standard function.
function dh_field_text($args) {

  // ###########################################################################
  // Fetching data.

  // Specifying target data.
  $entity_type = $args['entity_type'];
  $instance_id = $args['instance_id'];
  $field_id    = $args['field_id'];
  if (!empty($args['record']['meta']['text_formats'][$field_id])) {
    $text_format = $args['record']['meta']['text_formats'][$field_id];
  }
  else {
    $text_format = FALSE;
  }

  if (!empty($args['field_defs']['translatable'])) {
    if (!empty($args['fetch_locale'])) {
      $fetch_locale = 'locale_' . $args['fetch_locale'];
    }
    else {
      $fetch_locale = LOCALE_ID;
    }
    if (array_key_exists($fetch_locale, $args['record']['data'][$field_id])) {
      $text = $args['record']['data'][$field_id][$fetch_locale];
    }
    else {
      $text = FALSE;
    }
  }
  else {
    $text = $args['record']['data'][$field_id];
  }

  if ($text !== FALSE && $text !== NULL) {
    // Collecting data from an external file (if it's located there).
    if ($text === '[[external-file]]') {
      $external_file = $GLOBALS['registry']['app_current']['storage']
        . '/content_files/' . $fetch_locale . '/' . $entity_type
        . '/' . $instance_id . '__' . $field_id . '.' . $text_format;
      if (file_exists($external_file)) {
        $text = file_get_contents($external_file);
      }
      else {
        $text = FALSE;
        if (is_dev_mode()) {
          $message = 'Could not find content file for <em>'
            . escape_value($entity_type, 'attribute_value') . ': '
            . escape_value($instance_id, 'attribute_value') . '</em> at location'
            . ' <em>' . escape_value($external_file, 'href') . '</em>.';
        }
        else {
          $message = 'Could not find content file. Dev mode may have more info.';
        }
        sys_notify($message, 'warning');
      }
    }

    // Text filter.
    $filter_params = array(
      'text_format' => $text_format,
      'data' => $text,
    );
    $result = datautils_filter($filter_params);

    // #########################################################################
    // Wrapping results into the desired form of wrappers.

    $output = array(
      'field_type'    => 'text',
      'field_label'   => $args['field_defs']['label'],
      'field_content' => $result,
    );
    return $output;
  }
}
