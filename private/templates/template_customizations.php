<?php
/**
 * @file
 * Template customizations.
 */

/**
 * Customize entity instance presentations.
 */
function template_customize_entity_instance_field_list(&$args) {
  $args['variables']['wrapper_attributes']['class'][] = 'custom-class';
  $args['variables']['wrapper_attributes']['class'][] = 'custom-class-2';
}

/**
 * Customize fields.
 */
function template_customize_field(&$args) {
  // var_dump($args);
  if (!empty($args['for_field_handler']['field_id'])
      && $args['for_field_handler']['field_id'] == 'title') {
    $args['variables']['wrapper_attributes']['class'][] = 'yay-title-field!!!';
  }
}

/**
 * Customize blocks.
 */
function template_customize_block(&$args) {
  if (in_array('is--title-hidden', $args['wrapper_options']['attributes']['class'])) {
    $args['title_attributes']['class'][] = 'hidden';
  }

  // This part is not optional, all blocks need it...
  // UPDATE: could it be part of the pa_block() then?
  $args['variables']['title_attributes'] =
    templateutils_render_html_attributes($args['title_attributes']);
}

/**
 * Customize images.
 */
function template_customize_image(&$args) {
  $args['wrapper_options']['add_border_element'] = TRUE;
}
