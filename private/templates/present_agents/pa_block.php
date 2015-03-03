<?php
/**
 * Present agent: block.
 */

function pa_block(&$args) {
  $args['template_name'] = 'block';

  // Wrapper attributes.
  $args['wrapper_options']['attributes']['class'][] = 'block';
  $args['title_attributes'] = array(
    'class' => array(
      'block__title',
    ),
  );

  // FIXME:
  // Block should also do the field prerendering (cause an image field as the
  // content now fails)!
  // Dependency: more lean field templates (and arguments for field-renderer
  // to chose them).

  // Implementing assignments.
  if (!empty($args['raw_data']['field_title']['field_content'])) {
    $args['variables']['block_title'] =
      $args['raw_data']['field_title']['field_content'];
  }
  if (!empty($args['raw_data']['field_body']['field_content'])) {
    $args['variables']['block_content'] =
      $args['raw_data']['field_body']['field_content'];
  }
}
