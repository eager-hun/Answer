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
// GENERIC entity type.
$structure['entity_definitions']['generic'] = array(
  'properties' => array(
    'is_published',
  ),
  'fields' => array(
    // Fields with role: meta.

    // Fields with role: data.
    'field_title' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--title'),
    ),
    'field_body' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--body'),
    ),
  ),
);

// -----------------------------------------------------------------------------
// STATIC_PAGE entity type.
$structure['entity_definitions']['static_page'] = array(
  'properties' => array(
    'is_published',
  ),
  'fields' => array(
    // Fields with role: meta.
    'field_date_created' => array(
      'role' => 'meta',
      'type' => 'field_date',
      'translatable' => FALSE,
      'label' => loc('fl--date-published'),
    ),
    'field_date_lastmod' => array(
      'role' => 'meta',
      'type' => 'field_date',
      'translatable' => FALSE,
      'label' => loc('fl--date-lastmod'),
    ),
    // Fields with role: data.
    'field_title' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--title'),
    ),
    'field_subtitle' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--subtitle'),
    ),
    'field_body' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--body'),
    ),
    'field_attached_entities' => array(
      'role' => 'data',
      'type' => 'field_entity_attacher',
      'translatable' => FALSE,
      'label' => FALSE,
    ),
  ),
);

// -----------------------------------------------------------------------------
// ARTICLE entity type.
/**
 * Concerning author_id and author_name fields: you should use only one of them.
 *
 * If you want to print only the name of the author, use the author_name field,
 * which is a simple textfield.
 *
 * Else if you have an entity type to hold author profiles (equipped with
 * arbitrary fields), then use author_id, then attach the author enitity type
 * instance through the entity_attacher field. Then someone, somewhere should
 * look up the author_id that you provided in your article record, and then the
 * corresponding author instance would be attached.
 * P.S.: this latter thing is not yet developed.
 */
$structure['entity_definitions']['article'] = array(
  'properties' => array(
    'is_published',
  ),
  'fields' => array(
    // Fields with role: meta.
    'field_author_id' => array(
      'role' => 'meta',
      'type' => 'field_text',
      'translatable' => FALSE,
      'label' => FALSE,
    ),
    'field_date_created' => array(
      'role' => 'meta',
      'type' => 'field_date',
      'translatable' => FALSE,
      'label' => loc('fl--date-published'),
    ),
    'field_date_lastmod' => array(
      'role' => 'meta',
      'type' => 'field_date',
      'translatable' => FALSE,
      'label' => loc('fl--date-lastmod'),
    ),
    'field_preview_text' => array(
      'role' => 'meta',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--preview-text'),
    ),
    'field_preview_image' => array(
      'role' => 'meta',
      'type' => 'field_image',
      'style' => 'small',
      'translatable' => FALSE,
      'label' => loc('fl--preview-image'),
    ),
    // Fields with role: data.
    'field_author_name' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--author'),
    ),
    'field_title' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--title'),
    ),
    'field_subtitle' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--subtitle'),
    ),
    'field_body' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--body'),
    ),
    'field_attached_entities' => array(
      'role' => 'data',
      'type' => 'field_entity_attacher',
      'translatable' => FALSE,
      'label' => FALSE,
    ),
  ),
);

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

// -----------------------------------------------------------------------------
// IMAGE_DISPLAY entity type.
$structure['entity_definitions']['image_display'] = array(
  'properties' => array(
    'is_published',
  ),
  'fields' => array(
    // Fields with role: meta.
    'field_date_created' => array(
      'role' => 'meta',
      'type' => 'field_date',
      'translatable' => FALSE,
      'label' => loc('fl--date-published'),
    ),
    'field_date_lastmod' => array(
      'role' => 'meta',
      'type' => 'field_date',
      'translatable' => FALSE,
      'label' => loc('fl--date-lastmod'),
    ),
    'field_preview_text' => array(
      'role' => 'meta',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--preview-text'),
    ),
    'field_preview_image' => array(
      'role' => 'meta',
      'type' => 'field_image',
      'style' => 'medium',
      'translatable' => FALSE,
      'label' => loc('fl--preview-image'),
    ),
    // Fields with role: data.
    'field_title' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--title'),
    ),
    'field_subtitle' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--subtitle'),
    ),
    'field_body' => array(
      'role' => 'data',
      'type' => 'field_image',
      'style' => 'large',
      'translatable' => FALSE,
      'label' => loc('Image'),
    ),
    'field_caption' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => FALSE,
    ),
    'field_long_description' => array(
      'role' => 'data',
      'type' => 'field_text',
      'translatable' => TRUE,
      'label' => loc('fl--description'),
    ),
  ),
);


// #############################################################################
// Sections and contexts.

// -----------------------------------------------------------------------------
// Section definitions.

$structure['sections'] = array(
  // Key is main-section.
  'trusted' => array( // I don't remember what did I want from a 'trusted'...
    // Values are sub-sections belonging to this main-section.
    'admin',
    'devel',
  ),
  // Key is main-section.
  'articles_all' => array(),
  'images_all' => array(),
);

// -----------------------------------------------------------------------------
// Context definitions.

// If these conditions are being met, apply the following context.
$structure['contexts'] = array(
  'by_section' => array(

  ),
  // NOTE: this does not seem to work. (FIXME)
  'by_path' => array(
    // Key is context name.
    'noindex' => array(
      // Values are the triggering path partials (uri path's $args[0]).
      'search',
      'kereses',
    ),
  ),
);
