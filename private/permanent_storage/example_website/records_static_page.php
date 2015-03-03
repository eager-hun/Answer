<?php
/**
 * @file
 * Permanently stored data: records of 'static_page' entity type.
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

// -----------------------------------------------------------------------------
$static_page['home'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    // 'field_date_created'  => '2015-01-01',
    // 'field_date_lastmod'  => '2015-01-01',
    'field_title' => [
      'locale_primary'   => 'Welcome',
      'locale_secondary' => 'Üdvözlet',
    ],
    // 'field_subtitle' => [
    //   'locale_primary'   => '',
    //   'locale_secondary' => '',
    // ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
      'locale_secondary' => '[[external-file]]',
    ],
  ],
];
