<?php
/**
 * Present agent: block.
 */

function pa_block(&$args) {
  $args['template_name'] = 'block';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  $args['title_attributes'] = array(
    'class' => array(
      'block__title',
    ),
  );

  // Keeping only the title and body fields.
  $fields_to_keep = array(
    'field_title',
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
  if (!empty($args['raw_data']['field_title'])) {
    $args['variables']['block_title'] = $args['raw_data']['field_title'];
  }
  if (!empty($args['raw_data']['field_body'])) {
    $args['variables']['block_content'] = $args['raw_data']['field_body'];
  }
}
