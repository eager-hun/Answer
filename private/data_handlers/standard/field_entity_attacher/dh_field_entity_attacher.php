<?php
/**
 * @file
 * Data handler: entity attacher.
 *
 * Its job will be to append rendered entities to the end of the output of
 * entity_instance data handler's output.
 *
 * EDIT: Maybe this should be integrated into the entity_instance data handler?
 */

// Standard function.
function dh_field_entity_attacher($args) {
  $output = array(
    'field_type'    => 'entity_attacher',
    'field_label'   => $args['field_defs']['label'],
    'field_content' => 'This entity_attacher thing is unaddressed yet.',
  );
  return $output;
}
