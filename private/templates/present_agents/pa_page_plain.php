<?php
/**
 * Present agent: page plain.
 */

function pa_page_plain(&$args) {
  $args['template_name'] = 'layout_page_plain';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // Slot assingments.
  $args['variable_dispatcher_options'] = array(
    'assignments' => array(
      'slot_page_content' => array(
        'sys_notifications' => array(),
        'content_meta' => array(),
        'page_primary_content' => array(),
      ),
    ),
  );
}
