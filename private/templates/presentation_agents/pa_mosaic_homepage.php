<?php
/**
 * Present agent: mosaic_homepage.
 */

function pa_mosaic_homepage(&$args) {
  $args['template_name'] = 'layout_2sb';

  // Wrapper attributes.
  $args['wrapper_options']['attributes']['class'][] = 'content-level';
  $args['wrapper_options']['attributes']['class'][] = 'content-in-mid';

  // Slot assingments.
  $args['variable_dispatcher_options'] = array(
    'assignments' => array(
      'main_content' => array(
        'content_meta' => array(),
        'home' => array(),
        'articles-top' => array(),
      ),
      'sidebar_1' => array(
        'sidebar_1_default' => array(),
      ),
    ),
  );

  // Pre-rendering fields - in case an entity was passed in for presenting.
  if ($args['data_type'] == 'entity') {
    $args['raw_data'] = templateutils_prerender_fields($args);
  }
}
