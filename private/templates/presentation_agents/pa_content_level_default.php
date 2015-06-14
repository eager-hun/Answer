<?php
/**
 * Present agent: content level default.
 */

function pa_content_level_default(&$args) {
  $args['template_name'] = 'layout_2sb';

  // Wrapper attributes.
  $args['wrapper_options']['attributes']['class'][] = 'content-level';
  $args['wrapper_options']['attributes']['class'][] = 'content-level--default';
  $args['wrapper_options']['attributes']['class'][] = 'content-in-mid';

  // Slot assingments.
  $args['variable_dispatcher_options'] = array(
    'assignments' => array(
      'main_content' => array(
        'primary_content' => array(),
      ),
      'sidebar_1' => array(
        'sidebar_1_default' => array(),
      ),
      'sidebar_2' => array(
        'sidebar_2_default' => array(),
      ),
    ),
  );

  // Pre-rendering fields - in case an entity was passed in for presenting.
  if ($args['data_type'] == 'entity') {
    $args['raw_data'] = templateutils_prerender_fields($args);
  }
}
