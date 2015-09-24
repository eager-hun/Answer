<?php
/**
 * @file
 * Permanently stored data: records of 'dynamic_page' entity type.
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
// COMPONENTS DEMOS.

// -----------------------------------------------------------------------------
$dynamic_page['cd_index'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ]
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    'field_subtitle' => [
      'locale_primary'   => NULL,
      'locale_secondary' => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'cd_index',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic_page['cd_typography'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ]
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Typography',
      'locale_secondary' => NULL,
    ],
    'field_subtitle' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'cd_typography',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic_page['cd_in_text'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ]
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'In-text features',
      'locale_secondary' => NULL,
    ],
    'field_subtitle' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'cd_in_text',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic_page['cd_forms'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ]
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Forms',
      'locale_secondary' => NULL,
    ],
    'field_subtitle' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'cd_forms',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic_page['cd_grids_fbs'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ]
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Grids and flexbox layouts',
      'locale_secondary' => NULL,
    ],
    'field_subtitle' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'cd_grids_fbs',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic_page['cd_content_widgets'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ]
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Content widgets',
      'locale_secondary' => NULL,
    ],
    'field_subtitle' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'cd_content_widgets',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic_page['cd_ajax_modals'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'        => 'html',
      'field_subtitle'     => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ]
  ],
  'data' => [
    'field_date_created'  => NULL, // Format: YYYY-MM-DD.
    'field_date_lastmod'  => NULL, // Format: YYYY-MM-DD.
    'field_title' => [
      'locale_primary'   => 'Ajax operations and modals',
      'locale_secondary' => NULL,
    ],
    'field_subtitle' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'cd_ajax_modals',
      ],
    ],
  ],
];
