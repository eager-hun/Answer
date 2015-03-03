<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_page_default'] = array(
  'template_source' => 'function',
  'slots' => array(
    'slot_body_start'    => array(),
    'slot_header_level'  => array(),
    'slot_body_level'    => array(),
    'slot_body_end'      => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_page_default(&$args) {
  // Applying body attributes.
  $args['wrapper_options']['attributes']['class'][] = 'layout--page_default';
  $args['wrapper_options']['attributes'] = array_merge_recursive(
    $args['wrapper_options']['attributes'],
    $GLOBALS['temp']['raw_attributes']['body']
  );
  // Adding jump-links.
  apputils_wake_resource('data_handler', 'system_helpers');
  $jump_links = dh_system_helpers(array('order_id' => 'page_jump_links'));
  if (array_key_exists('slot_body_start', $args['variables'])) {
    // We append the jumplinks to it.
    $args['variables']['slot_body_start'] .= $jump_links;
  }
  else {
    // We populate it with the jumplinks.
    $args['variables']['slot_body_start'] = $jump_links;
  }
  // Adding javascripts.
  if (array_key_exists('slot_body_end', $args['variables'])) {
    // We append the javascript block to it.
    $args['variables']['slot_body_end'] .= pageutils_document_assets('body_js');
  }
  else {
    // We populate it with the javascript block.
    $args['variables']['slot_body_end'] = pageutils_document_assets('body_js');
  }
}

/**
 * Draw layout.
 */
function draw_layout_page_default($args) {
  $output = '<body' . $args['variables']['wrapper_attributes'] . ">\n";
  if (!empty($args['variables']['slot_body_start'])) {
    $output .= $args['variables']['slot_body_start'];
  }
  if (!empty($args['variables']['slot_header_level'])) {
    $output .= "<div class=\"page-level page-level--header\">\n<div class=\"page-center\">\n"
             . $args['variables']['slot_header_level']
             . "</div>\n</div>\n";
  }
  if (!empty($args['variables']['slot_body_level'])) {
    $output .= "<div class=\"page-level page-level--body\">\n<div class=\"page-center\">\n"
             . $args['variables']['slot_body_level']
             . "</div>\n</div>\n";
  }
  if (!empty($args['variables']['slot_body_end'])) {
    $output .= $args['variables']['slot_body_end'];
  }
  $output .= "</body>\n";
  return $output;
}
