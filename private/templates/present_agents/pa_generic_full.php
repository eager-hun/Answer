<?php
/**
 * Present agent: generic_full.
 */

function pa_generic_full(&$args) {
  $args['template_name'] = 'wrap';
  $args['variables']['wrapper_html_tag'] = 'article';

  // Wrapper attributes.
  $args['wrapper_options']['attributes']['class'][] = 'generic--full';

  // Keeping only the body field.
  $fields_to_keep = array(
    'field_body',
  );
  foreach($args['raw_data'] as $field_id => $field_data) {
    if (!in_array($field_id, $fields_to_keep)) {
      unset($args['raw_data'][$field_id]);
    }
  }

  // Pre-rendering fields.
  if ($args['data_type'] == 'entity') {
    $args['field_prerenderer_options'] = array(
      'template_variant' => 'plain',
    );
    $args['raw_data'] = templateutils_prerender_fields($args);
  }

  // Implementing assignments.
  $args['variables']['content'] = $args['raw_data']['field_body'];
}
