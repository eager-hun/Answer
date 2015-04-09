<?php
/**
 * Present agent: image_display_full.
 */

function pa_image_display_full(&$args) {
  $args['template_name'] = 'wrap';
  $args['variables']['wrapper_html_tag'] = 'article';

  // Wrapper attributes.
  $args['wrapper_options']['attributes']['class'][] = 'image_display--full';

  // Image alt attribute.
  // The field_caption is already sanitized by the text-field data-handler.
  $args['raw_data']['field_body']['field_content']['attributes']['alt'] =
    $args['raw_data']['field_caption']['field_content'];
  $args['raw_data']['field_body']['field_content']['attributes']['title'] =
    $args['raw_data']['field_caption']['field_content'];

  // Keeping only specific fields.
  $fields_to_keep = array(
    'field_body',
    'field_long_description',
  );
  foreach($args['raw_data'] as $field_id => $field_data) {
    if (!in_array($field_id, $fields_to_keep)) {
      unset($args['raw_data'][$field_id]);
    }
  }

  // Pre-rendering fields.
  if ($args['data_type'] == 'entity') {
    $args['field_prerenderer_options'] = array(
      'template_variant' => 'essence',
    );
    $args['raw_data'] = templateutils_prerender_fields($args);
  }

  // Implementing assignments.
  $args['variables']['content'] = implode("\n", $args['raw_data']);
}
