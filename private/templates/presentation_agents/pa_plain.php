<?php
/**
 * Present agent: plain.
 */

function pa_plain(&$args) {
  $args['template_name'] = 'plain';

  // Pre-rendering fields - in case an entity was passed in for presenting.
  if ($args['data_type'] == 'entity') {
    $args['raw_data'] = templateutils_prerender_fields($args);
  }

  // Implementing assignments.
  // Putting all the content into the 'content' of the template.
  $args['variables']['content'] = implode("\n", $args['raw_data']);
}
