<?php
/**
 * Present agent: single mock page.
 */

function pa_single_mock_page(&$args) {
  $args['template_name'] = 'layout_single_mock_page';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // Slot assingments.
  $args['variable_dispatcher_options'] = array(
    'assignments' => array(
      'slot_header_level' => array(
        'smp-header' => array(),
      ),
      'slot_main_level' => array(
        'smp-main' => array(),
        'smp-layout-plan' => array(),
      ),
      'slot_footer_level' => array(
        'smp-footer' => array(),
      ),
      'slot_notifications' => array(
        'sys_notifications' => array(),
      ),
    ),
  );
}
