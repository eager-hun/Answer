<?php
/**
 * @file
 * Permanently stored data: records of 'article' entity type.
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
$article['article-1'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_preview_text' => 'md',
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-01',
    'field_date_lastmod'  => '2015-01-01',
    'field_title' => [
      'locale_primary'    => 'Title of article 1',
      'locale_secondary'  => 'Cikk 1 címe',
    ],
    'field_subtitle' => [
      'locale_primary'    => 'Sub-title of article 1',
      'locale_secondary'  => 'Cikk 1 alcíme',
    ],
    'field_body' => [
      'locale_primary'    => '[[external-file]]',
      'locale_secondary'  => '[[external-file]]',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_image'         => 'sample-image.png',
  ],
];
$article['article-1']['data']['field_preview_text']['locale_primary'] = <<<EOT
Semi-long preview text for article 1.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus porttitor ipsum non suscipit. Donec in ullamcorper quam. Morbi molestie dui nec auctor.
EOT;
$article['article-1']['data']['field_preview_text']['locale_secondary'] = <<<EOT
Félhosszú előnézeti szöveg cikk 1 számára.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus porttitor ipsum non suscipit. Donec in ullamcorper quam. Morbi molestie dui nec auctor.
EOT;

// -----------------------------------------------------------------------------
$article['article-2'] = [
  'meta' => [
    'is_published' => 1,
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_preview_text' => 'md',
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-01',
    'field_date_lastmod'  => '2015-01-01',
    'field_title' => [
      'locale_primary'    => 'Title of article 2',
      'locale_secondary'  => 'Cikk 2 címe',
    ],
    'field_subtitle' => [
      'locale_primary'    => 'Sub-title of article 2',
      'locale_secondary'  => 'Cikk 2 alcíme',
    ],
    'field_body' => [
      'locale_primary'    => '[[external-file]]',
      'locale_secondary'  => '[[external-file]]',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_image'         => 'sample-image.png',
  ],
];
$article['article-2']['data']['field_preview_text']['locale_primary'] = <<<EOT
Semi-long preview text for article 2.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus porttitor ipsum non suscipit. Donec in ullamcorper quam. Morbi molestie dui nec auctor.
EOT;
$article['article-2']['data']['field_preview_text']['locale_secondary'] = <<<EOT
Félhosszú előnézeti szöveg cikk 2 számára.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus porttitor ipsum non suscipit. Donec in ullamcorper quam. Morbi molestie dui nec auctor.
EOT;

// -----------------------------------------------------------------------------
// NOTE: "DEPRECATED" CONTENT.
$article['article-3'] = [
  'meta' => [
    'is_published' => 1,
    'is_deprecated' => 1, // <--- NOTE: example for "deprecated" content.
    'supports_locales' => [
      'primary',
      'secondary',
    ],
    'text_formats' => [
      'field_preview_text' => 'md',
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
      'field_body'         => 'md',
    ],
  ],
  'data' => [
    'field_date_created'  => '2015-01-01',
    'field_date_lastmod'  => '2015-01-01',
    'field_title' => [
      'locale_primary'    => 'Title of article 3',
      'locale_secondary'  => 'Cikk 3 címe',
    ],
    'field_subtitle' => [
      'locale_primary'    => 'Sub-title of article 3',
      'locale_secondary'  => 'Cikk 3 alcíme',
    ],
    'field_body' => [
      'locale_primary'    => '[[external-file]]',
      'locale_secondary'  => '[[external-file]]',
    ],
    'field_preview_image' => 'sample-image.png',
    'field_image'         => 'sample-image.png',
  ],
];
$article['article-3']['data']['field_preview_text']['locale_primary'] = <<<EOT
Semi-long preview text for article 3.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus porttitor ipsum non suscipit. Donec in ullamcorper quam. Morbi molestie dui nec auctor.
EOT;
$article['article-3']['data']['field_preview_text']['locale_secondary'] = <<<EOT
Félhosszú előnézeti szöveg cikk 3 számára.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque finibus porttitor ipsum non suscipit. Donec in ullamcorper quam. Morbi molestie dui nec auctor.
EOT;
