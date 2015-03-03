<?php
/**
 * Present agent: mosaic_homepage.
 */

function pa_mosaic_homepage(&$args) {
  $args['template_name'] = 'layout_landing_1';

  // Wrapper attributes.
  $args['wrapper_options']['attributes']['class'][] = 'content-level';
  $args['wrapper_options']['attributes']['class'][] = 'content-level--homepage';

  // Slot assingments.
  $args['for_dispatcher'] = array(
    'assignments' => array(
      'top' => array(
        'content_meta' => array(),
      ),
      'minor_1' => array(
        'main-menu' => array(),
        'status-update' => array(),
        'mission-control-menu' => array(),
        'developers-menu' => array(),
        'menu-developer-menu' => array(), // Only for when doing development.
      ),
      'major_1' => array(
        'home' => array(),
      ),
      'major_2' => array(
        'articles_top' => array(),
      ),
    ),
  );

  // Pre-rendering fields - in case an entity was passed in for presenting.
  if ($args['data_type'] == 'entity') {
    $args['field_formatter_options'] = array();
    $args['raw_data'] = templateutils_prerender_fields($args);
  }
}
