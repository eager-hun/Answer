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
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id' => 'response_301',
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
      'locale_secondary' => 'Nem hozzáférhető tartalom',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id' => 'response_403',
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
      'locale_secondary' => 'A tartalom nem található',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id' => 'response_404',
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
      'locale_secondary' => 'A tartalom megszűnt',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id' => 'response_410',
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
      'locale_secondary' => 'Adminisztrátori funkciók',
    ],
    'field_description' => [
      'locale_primary'   => 'Note: the following buttons will perform immediate action; no questions will be asked, no confirmation will be requested.',
      'locale_secondary' => 'Figyelem: az alábbi gombok működtetése azonnali akciót von maga után; az alkalmazás további kérdések, vagy megerősítés kérése nélkül végrehajtja a feladatokat.',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => '',
    ],
  ],
];


// #############################################################################
// PAGE INTERFACE ELEMENTS.

// -----------------------------------------------------------------------------
$dynamic['header_branding'] = [
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
      'locale_secondary' => FALSE,
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'header_branding',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['header_widgets'] = [
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
      'locale_secondary' => FALSE,
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'header_widgets',
    ],
  ],
];

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
      'locale_secondary' => FALSE,
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'sys_notifications',
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
      'locale_secondary' => FALSE,
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'content_meta',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['site-lastmod'] = [
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
      'locale_secondary' => FALSE,
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'site_lastmod',
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
      'locale_primary'   => 'Main menu',
      'locale_secondary' => 'Főmenü',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'main_menu',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['footer-menu'] = [
  'meta' => [
    'is_published' => 1,
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
      'locale_primary'   => 'Footer menu',
      'locale_secondary' => 'Lábléc menü',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'footer_menu',
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
      'locale_primary'   => 'Mission control',
      'locale_secondary' => 'Mission control',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'mission_control_menu',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['developers-menu'] = [
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
      'locale_primary'   => 'Developer\'s menu',
      'locale_secondary' => 'Fejleszői menü',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'developers-menu',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['menu-developer-menu'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'       => 'txt',
      'field_description' => 'txt',
    ],
    'data_handlers' => [
      'field_body' => 'navigation',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Menu developer menu',
      'locale_secondary' => 'Menü-fejlesztéshez használatos menü',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'menu_developer_menu',
    ],
  ],
];


// #############################################################################
// FLEXILISTS.

// -----------------------------------------------------------------------------
$dynamic['articles_top'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'flexilist',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Selected articles',
      'locale_secondary' => 'Cikkajánló',
    ],
    // 'field_description' => [
    //   'locale_primary'   => '',
    //   'locale_secondary' => '',
    // ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'articles_top',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['articles-all'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'flexilist',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Articles',
      'locale_secondary' => 'Cikkek',
    ],
    // 'field_description' => [
    //   'locale_primary'   => 'I can haz description?',
    //   'locale_secondary' => '',
    // ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'articles_all',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['images-all'] = [
  'meta' => [
    'is_published' => 1,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'html',
    ],
    'data_handlers' => [
      'field_body' => 'flexilist',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Images',
      'locale_secondary' => 'Képek',
    ],
    // 'field_description' => [
    //   'locale_primary'   => '',
    //   'locale_secondary' => '',
    // ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'images_all',
    ],
  ],
];


// #############################################################################
// DEVELOPER CONTENT.

// -----------------------------------------------------------------------------
$dynamic['devel-project-1'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Project 1.',
      'locale_secondary' => 'Projekt 1.',
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'project_1',
    ],
  ],
];

// -----------------------------------------------------------------------------
$dynamic['devel-comp-demo'] = [
  'meta' => [
    'is_published' => 0,
    'text_formats' => [
      'field_title'       => 'html',
      'field_description' => 'md',
    ],
    'data_handlers' => [
      'field_body' => 'devel_entities',
    ],
  ],
  'data' => [
    'field_title' => [
      'locale_primary'   => 'Components demo',
      'locale_secondary' => NULL,
    ],
    // The field_body is arguments for the specified data-handler.
    'field_body' => [
      'order_id'   => 'components_demo',
    ],
  ],
];