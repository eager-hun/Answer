<?php
/**
 * Present agent: static_page_full.
 */

function pa_static_page_full(&$args) {
  $args['template_name'] = 'wrap';
  $args['variables']['wrapper_html_tag'] = 'article';

  // Wrapper attributes.
  $args['wrapper_options']['attributes']['class'][] = 'static-page--full';

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
    $args['field_formatter_options'] = array('without_label');
    $args['raw_data'] = templateutils_prerender_fields($args);
  }

  // Implementing assignments.
  $args['variables']['content'] = implode("\n", $args['raw_data']);
}
