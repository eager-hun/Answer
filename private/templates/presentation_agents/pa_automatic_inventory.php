<?php
/**
 * Present agent: automatic_inventory.
 */

function pa_automatic_inventory(&$args) {
  $args['template_name'] = 'wrap';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // Pre-rendering fields - in case an entity was passed in for presenting.
  if ($args['data_type'] == 'entity') {
    $args['raw_data'] = templateutils_prerender_fields($args);
  }

  // Implementing assignments.
  // Putting all the content into the 'content' of the template.
  $args['variables']['content'] = implode("\n", $args['raw_data']);
}
