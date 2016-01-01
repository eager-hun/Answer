<?php
/**
 * @file
 * Permanently stored data: records of 'dynamic' entity type.
 *
 * For the entity definition, see 'entity_definitions' in
 * definitions_structure.php.
 */


// #############################################################################
// SYSTEM PAGES.

// -----------------------------------------------------------------------------
$dynamic['http-301'] = [
  'meta' => [
    'is_published' => 1,
    'data_handlers' => [
      'field_body' => 'system_helpers',
    ]
  ],
  'data' => [
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'response_301',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['http-403'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title' => 'html',
      'field_body'  => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'system_helpers',
    ]
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Content not accessible',
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'response_403',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['http-404'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title' => 'html',
      'field_body'  => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'system_helpers',
    ]
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Content not found',
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'response_404',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['http-410'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title' => 'html',
      'field_body'  => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'system_helpers',
    ]
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Content is gone',
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'response_410',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['admin-interface'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'admin',
    ]
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Administrator tasks',
    ],
    'field_description' => [
      'locale_primary'   => 'Note: the following buttons will perform immediate action; no questions will be asked, no confirmation will be requested.',
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => '',
      ],
    ],
  ],
];


// #############################################################################
// PAGE INTERFACE ELEMENTS.

// -----------------------------------------------------------------------------
$dynamic['sys_notifications'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'system_helpers',
    ]
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => FALSE,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'sys_notifications',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['content_meta'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'system_helpers',
    ]
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => FALSE,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'content_meta',
      ],
    ],
  ],
];


// #############################################################################
// MENUS.

// -----------------------------------------------------------------------------
$dynamic['main-menu'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'navigation',
    ]
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => FALSE,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'main_menu',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['mission-control-menu'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'navigation',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => FALSE,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'mission_control_menu',
      ],
    ],
  ],
];


// #############################################################################
// PROTOTYPING: entities for the FULL PAGE PROTOTYPE.

// -----------------------------------------------------------------------------
$dynamic['fpp-header'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'fpp_helper',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'header',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['fpp-main'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'fpp_helper',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'main',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['fpp-footer'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'fpp_helper',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'footer',
      ],
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['fpp-layouts-demo'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'fpp_helper',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => NULL,
    ],
    // The field_body is instructions for the specified data-handler.
    'field_body' => [
      'args' => [
        'order_id' => 'layouts_demo',
      ],
    ],
  ],
];
