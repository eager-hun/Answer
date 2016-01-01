<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_full_page_prototype'] = array(
  'template_source' => 'php_template',
  'slots' => array(
    'slot_body_start'          => array(),
    'slot_header_level'        => array(),
    'slot_header_suffix_level' => array(),
    'slot_main_level'          => array(),
    'slot_footer_level'        => array(),
    'slot_body_end'            => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_full_page_prototype(&$args) {

  // Applying body attributes.
  $args['wrapper_options']['attributes'] = array_merge_recursive(
    $args['wrapper_options']['attributes'],
    $GLOBALS['temp']['raw_attributes']['body']
  );

  // Preparing body start. (Would there be a better place for these actions?)
  $body_start_pipeline =
    ensafe_string(implode("\n", $GLOBALS['temp']['layout_elements']['body_start']), 'html');
  if (array_key_exists('slot_body_start', $args['variables'])) {
    $args['variables']['slot_body_start'] =
      $body_start_pipeline . "\n" . $args['variables']['slot_body_start'];
  }
  else {
    $args['variables']['slot_body_start'] = $body_start_pipeline;
  }
  // Preparing body end. (Would there be a better place for these actions?)
  $body_end_pipeline =
    ensafe_string(implode("\n", $GLOBALS['temp']['layout_elements']['body_end']), 'html');
  if (array_key_exists('slot_body_end', $args['variables'])) {
    $args['variables']['slot_body_end'] =
      $body_end_pipeline . "\n" . $args['variables']['slot_body_end'];
  }
  else {
    $args['variables']['slot_body_end'] = $body_end_pipeline;
  }

  // Adding jump-links.
  if (!empty($GLOBALS['config']['ui']['enable_jump_links'])) {
    apputils_wake_resource('data_handler', 'system_helpers');
    $jump_links = dh_system_helpers(array('order_id' => 'page_jump_links'));
    $args['variables']['slot_body_start'] .= $jump_links;
  }

  // Adding javascripts.
  $args['variables']['slot_body_end'] .= pageutils_document_assets('body_js');
}
