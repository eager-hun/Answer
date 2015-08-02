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
  // Some manually invoked field render calls don't provide 'field_meta'.
  // TODO: all field render calls could be refactored to go through
  // templateutils_prerender_fields(), so that we always had a normalized set of
  // args.
  if (array_key_exists('field_meta', $args)) {
    // Adding image borders: the enabler class on the wrapper around the
    // to-be-bordered images.
    if ($args['field_meta']['field_type'] == 'image') {
      $args['variables']['wrapper_attributes']['class'][] = 'images--bordered';
    }
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
  // Adding image borders: providing an extra span.img__border around the img.
  $args['wrapper_options']['add_border_element'] = TRUE;
}
