<?php
/**
 * Present agent: page default.
 */

function pa_page_default(&$args) {
  $args['template_name'] = 'layout_page_default';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // Slot assingments.
  $args['for_dispatcher'] = array(
    'assignments' => array(
      'slot_header_level' => array(
        'header_default' => array(),
        'header_suffix_default' => array(),
      ),
      'slot_body_level' => array(
        'content_level_default' => array(),
        'footer_default' => array(),
      ),
    ),
  );
}
