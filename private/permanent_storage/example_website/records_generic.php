<?php
/**
 * @file
 * Permanently stored data: records of 'generic' entity type.
 *
 * For the entity definition, see 'entity_definitions' in
 * definitions_structure.php.
 *
 * Text-type fields' contents can be stored in external files. In such cases,
 * the value of the field should be set to: '[[external-file]]'.
 *
 * The path for these fields' external content files should be:
 *
 * registry[private_assets]/
 *   permanent-storage/
 *     [website_instance_name]/
 *       content_files/
 *         locale_[locale-key]/
 *           [entity_type]/
 *             [entity_id]__[field_name].[extension]
 *
 * (...where the file extension should match the value supplied in the record's
 * ['meta']['text_formats'] array for the given field.)
 */


// #############################################################################
// ADMIN CONTENT.

// -----------------------------------------------------------------------------
$generic['operating-manual'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'      => 'html',
      'field_body'       => 'md',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Operating manual',
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
    ],
  ],
];

// -----------------------------------------------------------------------------
$generic['article-ideas'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'      => 'html',
      'field_body'       => 'md',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Article ideas',
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
    ],
  ],
];

// -----------------------------------------------------------------------------
$generic['site-structure-planning'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'      => 'html',
      'field_body'       => 'md',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Site structure planning',
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
    ],
  ],
];
