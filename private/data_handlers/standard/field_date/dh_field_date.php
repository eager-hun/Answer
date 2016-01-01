<?php
/**
 * @file
 * Field handler for date type fields.
 */

// Standard function.
function dh_field_date($args) {
  $output = array();
  // First, collecting info for formatting.
  $langcode = $GLOBALS['config']['document']['locale'][LOCALE_KEY]['langcode'];
  if ($langcode == 'hu') {
    $format = "Y. F j.";
  }
  else {
    $format = "j F Y";
  }
  // Deciding input source and output style.
  if (!empty($args['order'])) {
    $raw_value = $args['order']['data'];
    if (!empty($args['order']['options'])) {
      $options = $args['order']['options'];
    }
    else {
      $options = FALSE;
    }
    $output = _get_date_safely($raw_value, $format, $options);
  }
  else {
    $field_id = $args['field_id']; // Which field we are working for right now.
    $raw_value = $args['record']['data'][$field_id];
    $output['field_type'] = 'date';
    $output['field_label'] = $args['field_defs']['label'];
    $output['field_content'] = _get_date_safely($raw_value, $format);
  }
  return $output;
}

/**
 * Reusable careful formatting of date.
 */
function _get_date_safely($raw_value, $format, $options = array()) {
  // Let's not allow processing the input if it is an empty string.
  // (The following would produce the _current_ date in such case, but that
  // could end up being misleading.)
  if (!empty($raw_value)
      || !empty($options) && in_array('return_current', $options)) {
    // If the raw input was eligibly formatted.
    if (($date_object = date_create($raw_value)) !== FALSE) {
      return date_format($date_object, $format);
    }
    // Else date_create() refused to work with the string.
    else {
      return escape_value($raw_value);
    }
  }
}
