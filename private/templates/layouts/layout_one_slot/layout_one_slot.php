<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_one_slot'] = array(
  'template_source' => 'function',
  'slots' => array(
    'slot_1' => array(),
  ),
);

/**
 * Draw layout.
 */
function draw_layout_one_slot($args) {
  $output = "\n<div" . $args['variables']['wrapper_attributes'] . ">\n";
  if (!empty($args['variables']['slot_1'])) {
    $output .= "<div class='slot slot_1'>" . $args['variables']['slot_1']
      . "\n</div>\n";
  }
  $output .= "</div>";
  return $output;
}
