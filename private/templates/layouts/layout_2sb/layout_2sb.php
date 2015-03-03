<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_2sb'] = array(
  'template_source' => 'function',
  'slots' => array(
    'main_content' => array(),
    'sidebar_1' => array(),
    'sidebar_2' => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_2sb(&$args) {
  $args['wrapper_options']['attributes']['class'][] = 'grid';
  $args['wrapper_options']['attributes']['class'][] = 'layout--2sb';

  if (empty($args['variables']['sidebar_1'])
      && empty($args['variables']['sidebar_2'])) {
    $args['wrapper_options']['attributes']['class'][] = 'has-no-sb';
  }
  elseif (!empty($args['variables']['sidebar_1'])
          && empty($args['variables']['sidebar_2'])) {
    $args['wrapper_options']['attributes']['class'][] = 'has-1-sb';
    $args['wrapper_options']['attributes']['class'][] = 'sb-1';
  }
  elseif (empty($args['variables']['sidebar_1'])
          && !empty($args['variables']['sidebar_2'])) {
    $args['wrapper_options']['attributes']['class'][] = 'has-1-sb';
    $args['wrapper_options']['attributes']['class'][] = 'sb-2';
  }
  elseif (!empty($args['variables']['sidebar_1'])
          && !empty($args['variables']['sidebar_2'])) {
    $args['wrapper_options']['attributes']['class'][] = 'has-2-sb';
  }
}

/**
 * Draw layout.
 */
function draw_layout_2sb($args) {
  $output = '<div' . $args['variables']['wrapper_attributes'] . ">\n";
  if (!empty($args['variables']['main_content'])) {
    $output .= "<div class='grid-item column main_content'>\n"
      . $args['variables']['main_content']
      . "\n</div>\n";
  }
  if (!empty($args['variables']['sidebar_1'])) {
    $output .= "<div class='grid-item column sidebar sidebar_1'>\n"
      . $args['variables']['sidebar_1']
      . "\n</div>\n";
  }
  if (!empty($args['variables']['sidebar_2'])) {
    $output .= "<div class='grid-item column sidebar sidebar_2'>\n"
      . $args['variables']['sidebar_2']
      . "\n</div>\n";
  }
  $output .= "</div>\n";
  return $output;
}
