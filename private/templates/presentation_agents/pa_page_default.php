<?php
/**
 * Present agent: page default.
 */

function pa_page_default(&$args) {
  $args['template_name'] = 'layout_page_default';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // For debugging modernizr-based fallbacks.
  // $args['wrapper_options']['attributes']['class'][] = 'mdz-no-flexbox';

  // Slot assingments.
  $args['variable_dispatcher_options'] = array(
    'assignments' => array(
      'slot_header_level' => array(
        'header_default' => array(),
        'header_suffix_default' => array(),
      ),
      'slot_main_level' => array(
        'content_level_default' => array(),
      ),
      'slot_footer_level' => array(
        'footer_default' => array(),
      ),
    ),
  );
}
