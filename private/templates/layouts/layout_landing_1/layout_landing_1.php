<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_landing_1'] = array(
  'template_source' => 'function',
  'slots' => array(
    'top' => array(),
    'minor_1' => array(),
    'major_1' => array(),
    'major_2' => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_landing_1(&$args) {
  $args['wrapper_options']['attributes']['class'][] = 'grid';
  $args['wrapper_options']['attributes']['class'][] = 'layout--landing_1';
}

/**
 * Draw layout.
 */
function draw_layout_landing_1($args) {
  $output = '<div' . $args['variables']['wrapper_attributes'] . ">\n";

  $output .= '<div class="grid-item grid column column--main">';
  if (!empty($args['variables']['top'])) {
    $output .= "<div class='grid-item slot--top'>\n"
      . $args['variables']['top']
      . "\n</div>\n";
  }
  if (!empty($args['variables']['major_1'])) {
    $output .= "<div class='grid-item slot--major_1'>\n"
      . $args['variables']['major_1']
      . "\n</div>\n";
  }
  if (!empty($args['variables']['major_2'])) {
    $output .= "<div class='grid-item slot--major_2'>\n"
      . $args['variables']['major_2']
      . "\n</div>\n";
  }
  $output .= "</div>\n"; // .main-wrap.

  if (!empty($args['variables']['minor_1'])) {
    $output .= "<div class='grid-item column sidebar'>\n"
      . $args['variables']['minor_1']
      . "\n</div>\n";
  }
  $output .= "</div>\n";
  return $output;
}
