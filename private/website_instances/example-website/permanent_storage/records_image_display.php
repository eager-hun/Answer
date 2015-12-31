<?php
/**
 * @file
 * Permanently stored data: records of 'image_display' entity type.
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
 *   website_instances/
 *     [website_instance_name]/
 *       permanent-storage/
 *         content_files/
 *           locale_[locale-key]/
 *             [entity_type]/
 *               [entity_id]__[field_name].[extension]
 *
 * (...where the file extension should match the value supplied in the record's
 * ['meta']['text_formats'] array for the given field.)
 */

// -----------------------------------------------------------------------------
$image_display['test-image-1'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_title'            => 'html',
      'field_subtitle'         => 'html',
      'field_caption'          => 'txt',
      'field_preview_text'     => 'md',
      'field_long_description' => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-04',
    // 'field_date_lastmod'  => '',
    'field_title' => [
      'locale_primary'    => 'Test image display',
      'locale_secondary'  => 'Kép-bemutató teszt',
    ],
    'field_body'          => 'sample-image.png',
    'field_caption' => [
      'locale_primary'    => 'Caption for this image',
      'locale_secondary'  => 'Képaláírás ehhez a képhez',
    ],
    'field_long_description' => [
      'locale_primary'    => '[[external-file]]',
      'locale_secondary'  => '[[external-file]]',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_preview_text' => [
      'locale_primary'    => 'Preview text for this image.',
      'locale_secondary'  => 'Előnézeti szöveg ehhez a képhez.',
    ],
  ],
];

// -----------------------------------------------------------------------------
$image_display['test-image-2'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_title'            => 'html',
      'field_subtitle'         => 'html',
      'field_caption'          => 'txt',
      'field_preview_text'     => 'md',
      'field_long_description' => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-04',
    // 'field_date_lastmod'  => '',
    'field_title' => [
      'locale_primary'    => 'Test image display 2',
      'locale_secondary'  => 'Kép-bemutató teszt 2',
    ],
    'field_body'          => 'sample-image.png',
    'field_caption' => [
      'locale_primary'    => 'Caption for this image',
      'locale_secondary'  => 'Képaláírás ehhez a képhez',
    ],
    'field_long_description' => [
      'locale_primary'    => 'Long description here.',
      'locale_secondary'  => 'Itt a hosszú leírás.',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_preview_text' => [
      'locale_primary'    => 'Preview text for this image.',
      'locale_secondary'  => 'Előnézeti szöveg ehhez a képhez.',
    ],
  ],
];

// -----------------------------------------------------------------------------
$image_display['test-image-3'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_title'            => 'html',
      'field_subtitle'         => 'html',
      'field_caption'          => 'txt',
      'field_preview_text'     => 'md',
      'field_long_description' => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-04',
    // 'field_date_lastmod'  => '',
    'field_title' => [
      'locale_primary'    => 'Test image display 3',
      'locale_secondary'  => 'Kép-bemutató teszt 3',
    ],
    'field_body'          => 'sample-image.png',
    'field_caption' => [
      'locale_primary'    => 'Caption for this image',
      'locale_secondary'  => 'Képaláírás ehhez a képhez',
    ],
    'field_long_description' => [
      'locale_primary'    => 'Long description here.',
      'locale_secondary'  => 'Itt a hosszú leírás.',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_preview_text' => [
      'locale_primary'    => 'Preview text for this image.',
      'locale_secondary'  => 'Előnézeti szöveg ehhez a képhez.',
    ],
  ],
];

// -----------------------------------------------------------------------------
$image_display['test-image-4'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_title'            => 'html',
      'field_subtitle'         => 'html',
      'field_caption'          => 'txt',
      'field_preview_text'     => 'md',
      'field_long_description' => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-04',
    // 'field_date_lastmod'  => '',
    'field_title' => [
      'locale_primary'    => 'Test image display 4',
      'locale_secondary'  => 'Kép-bemutató teszt 4',
    ],
    'field_body'          => 'sample-image.png',
    'field_caption' => [
      'locale_primary'    => 'Caption for this image',
      'locale_secondary'  => 'Képaláírás ehhez a képhez',
    ],
    'field_long_description' => [
      'locale_primary'    => 'Long description here.',
      'locale_secondary'  => 'Itt a hosszú leírás.',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_preview_text' => [
      'locale_primary'    => 'Preview text for this image.',
      'locale_secondary'  => 'Előnézeti szöveg ehhez a képhez.',
    ],
  ],
];

// -----------------------------------------------------------------------------
$image_display['test-image-5'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_title'            => 'html',
      'field_subtitle'         => 'html',
      'field_caption'          => 'txt',
      'field_preview_text'     => 'md',
      'field_long_description' => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-04',
    // 'field_date_lastmod'  => '',
    'field_title' => [
      'locale_primary'    => 'Test image display 5',
      'locale_secondary'  => 'Kép-bemutató teszt 5',
    ],
    'field_body'          => 'sample-image.png',
    'field_caption' => [
      'locale_primary'    => 'Caption for this image',
      'locale_secondary'  => 'Képaláírás ehhez a képhez',
    ],
    'field_long_description' => [
      'locale_primary'    => 'Long description here.',
      'locale_secondary'  => 'Itt a hosszú leírás.',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_preview_text' => [
      'locale_primary'    => 'Preview text for this image.',
      'locale_secondary'  => 'Előnézeti szöveg ehhez a képhez.',
    ],
  ],
];


// -----------------------------------------------------------------------------
$image_display['test-image-6'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_title'            => 'html',
      'field_subtitle'         => 'html',
      'field_caption'          => 'txt',
      'field_preview_text'     => 'md',
      'field_long_description' => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-04',
    // 'field_date_lastmod'  => '',
    'field_title' => [
      'locale_primary'    => 'Test image display 6',
      'locale_secondary'  => 'Kép-bemutató teszt 6',
    ],
    'field_body'          => 'sample-image.png',
    'field_caption' => [
      'locale_primary'    => 'Caption for this image',
      'locale_secondary'  => 'Képaláírás ehhez a képhez',
    ],
    'field_long_description' => [
      'locale_primary'    => 'Long description here.',
      'locale_secondary'  => 'Itt a hosszú leírás.',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_preview_text' => [
      'locale_primary'    => 'Preview text for this image.',
      'locale_secondary'  => 'Előnézeti szöveg ehhez a képhez.',
    ],
  ],
];
