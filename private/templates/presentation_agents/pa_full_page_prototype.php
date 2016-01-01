<?php
/**
 * Present agent: single mock page.
 */

function pa_full_page_prototype(&$args) {
  $args['template_name'] = 'layout_full_page_prototype';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // Slot assingments.
  $args['variable_dispatcher_options'] = array(
    'assignments' => array(
      'slot_header_level' => array(
        'fpp-header' => array(),
      ),
      'slot_header_suffix_level' => array(
        'sys_notifications' => array(),
        'main-menu' => array(),
        'mission-control-menu' => array(),
      ),
      'slot_main_level' => array(
        'fpp-main' => array(),
      ),
      'slot_footer_level' => array(
        'fpp-footer' => array(),
      ),
    ),
  );
}
