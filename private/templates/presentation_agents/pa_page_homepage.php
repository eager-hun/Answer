<?php
/**
 * Present agent: page homepage.
 */

function pa_page_homepage(&$args) {
  $args['template_name'] = 'layout_page_default';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // Slot assingments.
  $args['variable_dispatcher_options'] = array(
    'assignments' => array(
      'slot_header_level' => array(
        'header_default' => array(),
        'header_suffix_default' => array(),
      ),
      'slot_body_level' => array(
        'mosaic_homepage' => array(),
        'footer_default' => array(),
      ),
    ),
  );
}
