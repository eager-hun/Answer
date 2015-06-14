<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_2col_asm_combi'] = array(
  'template_source' => 'php_template',
  'slots' => array(
    'slot_top'    => array(),
    'slot_col_1'  => array(),
    'slot_col_2'  => array(),
    'slot_bottom' => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_2col_asm_combi(&$args) {
  $args['wrapper_options']['attributes']['class'][] = 'grid';
}
