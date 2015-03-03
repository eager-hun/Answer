<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_two_slots'] = array(
  'template_source' => 'function',
  'slots' => array(
    'slot_1' => array(),
    'slot_2' => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_two_slots(&$args) {
  $args['wrapper_options']['attributes']['class'][] = 'layout';
  $args['wrapper_options']['attributes']['class'][] = 'layout--two_slots';
}

/**
 * Draw layout.
 */
function draw_layout_two_slots($args) {
  $output = '<div' . $args['variables']['wrapper_attributes'] . ">\n";
  if (!empty($args['variables']['slot_1'])) {
    $output .= "<div class='slot slot_1'>\n" . $args['variables']['slot_1']
      . "\n</div><!-- /.slot -->\n";
  }
  if (!empty($args['variables']['slot_2'])) {
    $output .= "<div class='slot slot_2'>\n" . $args['variables']['slot_2']
      . "\n</div><!-- /.slot -->\n";
  }
  $output .= "</div><!-- /.layout--two-slots -->\n";
  return $output;
}
