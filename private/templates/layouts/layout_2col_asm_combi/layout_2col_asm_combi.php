<?php
/**
 * Layout.
 *
 * NOTE: in single-column mode (small screens), slot_right_top precedes
 * slot_left, while slot_right_bottom comes after it.
 *
 * In simple cases, it might be sufficient to use only either slot_right_top or
 * slot_right_bottom at a time.
 *
 * Where the top-vs-bottom trickery is really useful, is in e.g. entity
 * previews, where the setup:
 *   entity title  -> slot_right_top
 *   preview image -> slot_left
 *   preview text  -> slot_right_bottom
 * results in the desired two-col layout on large screens, while helps
 * maintaining the right order of things on (single-column) small screens by
 * putting the title first, then the image, finally the preview text.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_2col_asm_combi'] = array(
  'template_source' => 'php_template',
  'slots' => array(
    'slot_top'          => array(),
    'slot_right_top'    => array(),
    'slot_left'         => array(),
    'slot_right_bottom' => array(),
    'slot_bottom'       => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_2col_asm_combi(&$args) {
  $args['wrapper_options']['attributes']['class'][] = 'grid';

  if (!empty($args['variables']['slot_left'])) {
    $args['wrapper_options']['attributes']['class'][] = 'has_left_col';
  }
  if (empty($args['variables']['slot_bottom'])) {
    $args['wrapper_options']['attributes']['class'][] = 'has-no-slot-bottom';
  }
}
