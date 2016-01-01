<?php
/**
 * @file
 * Definitions concerning structure.
 */

// #############################################################################
// Entity (fields') definitions.
// Note: each field's 'type' value is the name of the data_handler that is
// supposed to be processing the data that is supplied in the given field.

// -----------------------------------------------------------------------------
// DYNAMIC entity type. (e.g. menus fall in this type.)
$structure['entity_definitions']['dynamic'] = array(
  'properties' => array(
    'is_published',
  ),
  'fields' => array(
    // Fields with role: data.
    'field_title' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--title'),
    ),
    'field_description' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--description'),
    ),
    'field_body' => array(
      'role' => 'data',
      'type' => 'field_php',
      'translatable' => FALSE,
      'label' => FALSE,
    ),
  ),
);


// #############################################################################
// Sections and contexts.

// -----------------------------------------------------------------------------
// Section definitions.

$structure['sections'] = array(

);

// -----------------------------------------------------------------------------
// Context definitions.

// If these conditions are being met, apply the following context.
$structure['contexts'] = array(
  'by_section' => array(

  ),
  // NOTE: this does not seem to work. (FIXME)
  'by_path' => array(

  ),
);
