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
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Welcome',
      'locale_secondary' => 'Üdvözlet',
    ],
    'field_subtitle' => [
      'locale_primary'   => NULL,
      'locale_secondary' => NULL,
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
      'locale_secondary' => '[[external-file]]',
    ],
  ],
];


// #############################################################################
// MISSION CONTROL.

// -----------------------------------------------------------------------------
$static_page['mc-operating-manual'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Operating manual',
    ],
    'field_subtitle' => [
      'locale_primary'   => NULL,
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
    ],
  ],
];

// -----------------------------------------------------------------------------
$static_page['mc-planning-outline'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Site outline planning',
    ],
    'field_subtitle' => [
      'locale_primary'   => NULL,
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
    ],
  ],
];

// -----------------------------------------------------------------------------
$static_page['mc-planning-taxonomy'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Taxonomy planning',
    ],
    'field_subtitle' => [
      'locale_primary'   => NULL,
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
    ],
  ],
];


// #############################################################################
// DEVELOPER PAGES.

// -----------------------------------------------------------------------------
$static_page['devel-docs'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Documentation for developers',
    ],
    'field_subtitle' => [
      'locale_primary'   => NULL,
    ],
    'field_body' => [
      'locale_primary'   => '[[external-file]]',
    ],
  ],
];
