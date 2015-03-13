<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_page_plain'] = array(
  'template_source' => 'function',
  'slots' => array(
    'slot_body_start'    => array(),
    'slot_page_content'  => array(),
    'slot_body_end'      => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_page_plain(&$args) {
  // Applying body attributes.
  $args['wrapper_options']['attributes']['class'][] = 'layout--page_plain';
  $args['wrapper_options']['attributes'] = array_merge_recursive(
    $args['wrapper_options']['attributes'],
    $GLOBALS['temp']['raw_attributes']['body']
  );

  // Throwing out styles.
  pageutils_reset_styles();
  // Throwing out scripts.
  pageutils_reset_javascripts();

  // Applying custom styles.
  $GLOBALS['config']['ui'] = array(
    'css_external' => array(
      array(
        'source' => 'theme_generated',
        'file'   => 'styles_plain_output.css',
      ),
    ),
  );
}

/**
 * Draw layout.
 */
function draw_layout_page_plain($args) {
  $output = '<body' . $args['variables']['wrapper_attributes'] . ">\n";
  if (!empty($args['variables']['slot_body_start'])) {
    $output .= $args['variables']['slot_body_start'];
  }
  if (!empty($args['variables']['slot_page_content'])) {
    $output .= "<div class=\"page-content\">\n"
             . $args['variables']['slot_page_content']
             . "</div>\n";
  }
  if (!empty($args['variables']['slot_body_end'])) {
    $output .= $args['variables']['slot_body_end'];
  }
  $output .= "</body>\n";
  return $output;
}
