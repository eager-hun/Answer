<?php
/**
 * @file
 * Place to define pages for the website.
 */

/*
$pages['page-id-comes-here'] = [ // Should be the same as the instance_id!
  'data_type'         => '', // entity or binder.
  'entity_type'       => '', // Provide this, if it's an entity.
  'instance_id'       => '', // page_id should be the same as this one!
  'meta_descriptions' => [
    'primary'   => 'Meta description for this page.',
    'secondary' => 'Meta leírás ennek az oldalnak.',
  ],
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'path/to/page',
    'secondary' => 'utvonal/az/oldalhoz',
  ],
  'in_section'        => '', // Use a single one: the nested-most section.
  'in_context'        => '', // CSV.
  'is_published'      => 1,  // NOTE: only for binder-pages!
  'xml_sitemap_include' => 1,
];
*/

// -----------------------------------------------------------------------------
$pages['home'] = [
  // 'data_type'        => 'entity',
  // 'entity_type'      => 'static_page',
  // 'instance_id'      => 'home',
  'data_type'        => 'binder',
  'instance_id'      => 'mosaic_homepage',
  'present_as'       => 'mosaic_homepage',
  'template_variant' => 'page_homepage',
  'meta_descriptions' => [
    'primary'   => 'Meta description for this page.',
    'secondary' => 'Meta leírás ennek az oldalnak.',
  ],
  'has_translations'  => 0, // Special setting for the 'home' page.
  'paths' => [
    'primary'   => '',
    'secondary' => '',
  ],
  'in_section'        => '',
  'in_context'        => '',
  'is_published'      => 1,
  'xml_sitemap_include' => 1,
];


// #############################################################################
// Articles.

// -----------------------------------------------------------------------------
$pages['articles-all'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'articles-all',
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'articles/',
    'secondary' => 'cikkek/',
  ],
  'in_section'        => '',
  'in_context'        => '',
];

// -----------------------------------------------------------------------------
$pages['article-1'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'article',
  'instance_id'       => 'article-1',
  'meta_descriptions' => [
    'primary'   => 'Meta description for this page.',
    'secondary' => 'Meta leírás ennek az oldalnak.',
  ],
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'articles/article-one-path',
    'secondary' => 'cikkek/cikk-egy-utvonal',
  ],
  'in_section'        => 'articles_all',
  'in_context'        => '',
  'xml_sitemap_include' => 1,
];

// -----------------------------------------------------------------------------
$pages['article-2'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'article',
  'instance_id'       => 'article-2',
  'meta_descriptions' => [
    'primary'   => 'Meta description for this page.',
    'secondary' => 'Meta leírás ennek az oldalnak.',
  ],
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'articles/article-two-path',
    'secondary' => 'cikkek/cikk-ketto-utvonal',
  ],
  'in_section'        => 'articles_all',
  'in_context'        => '',
  'xml_sitemap_include' => 1,
];

// -----------------------------------------------------------------------------
// NOTE: "DEPRECATED" CONTENT.
$pages['article-3'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'article',
  'instance_id'       => 'article-3',
  'meta_descriptions' => [
    'primary'   => 'Meta description for this page.',
    'secondary' => 'Meta leírás ennek az oldalnak.',
  ],
  'has_translations'  => 0, // Not important, as language switcher won't be shown.
  'paths' => [
    'primary'   => 'articles/article-three-path',
    'secondary' => 'cikkek/cikk-harom-utvonal',
  ],
  'in_section'        => 'articles_all',
  'in_context'        => 'deprecated',
  'xml_sitemap_include' => 1,
];


// #############################################################################
// IMAGE DISPLAYS.

// -----------------------------------------------------------------------------
$pages['images-all'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'images-all',
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'images/',
    'secondary' => 'kepek/',
  ],
  'in_section'        => '',
  'in_context'        => '',
  'xml_sitemap_include' => 1,
];

// -----------------------------------------------------------------------------
$pages['test-image-1'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'image_display',
  'instance_id'       => 'test-image-1',
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'images/1',
    'secondary' => 'kepek/1',
  ],
  'in_section'        => 'images_all',
  'in_context'        => '',
  'xml_sitemap_include' => 1,
];

// -----------------------------------------------------------------------------
$pages['test-image-2'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'image_display',
  'instance_id'       => 'test-image-2',
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'images/2',
    'secondary' => 'kepek/2',
  ],
  'in_section'        => 'images_all',
  'in_context'        => '',
  'xml_sitemap_include' => 1,
];


// #############################################################################
// 301s.

// -----------------------------------------------------------------------------
// Redirecting the slash-less 'articles' path to the slashed one.
$pages['301-articles'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'http-301',
  'paths' => [
    'primary'   => 'articles',
    'secondary' => 'cikkek',
  ],
  'new_locations' => [
    'primary'   => base_path(array('for_locale' => 'primary')) . 'articles/',
    'secondary' => base_path(array('for_locale' => 'secondary')) . 'cikkek/',
  ],
];

// -----------------------------------------------------------------------------
$pages['301-images'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'http-301',
  'paths' => [
    'primary'   => 'images',
    'secondary' => 'kepek',
  ],
  'new_locations' => [
    'primary'   => base_path(array('for_locale' => 'primary')) . 'images/',
    'secondary' => base_path(array('for_locale' => 'secondary')) . 'kepek/',
  ],
];


// #############################################################################
// GONE PAGES.

// -----------------------------------------------------------------------------
$pages['gone-example'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'http-410',
  'paths' => [
    'primary'   => 'example-gone-contents-path',
    'secondary' => 'pelda-megszunt-tartalom-utvonala',
  ],
];


// #############################################################################
// MISSON CONTROL ELEMENTS.

// -----------------------------------------------------------------------------
$pages['mc-operating-manual'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'static_page',
  'instance_id'       => 'mc-operating-manual',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'mission-control/operating-manual',
  ],
  'in_section'        => 'mission_control',
  'in_context'        => 'noindex,',
];

// -----------------------------------------------------------------------------
$pages['mc-planning-outline'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'static_page',
  'instance_id'       => 'mc-planning-outline',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'mission-control/site-outline-planning',
  ],
  'in_section'        => 'mission_control',
  'in_context'        => 'noindex',
];

// -----------------------------------------------------------------------------
$pages['mc-planning-taxonomy'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'static_page',
  'instance_id'       => 'mc-planning-taxonomy',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'mission-control/taxonomy-planning',
  ],
  'in_section'        => 'mission_control',
  'in_context'        => 'noindex',
];

// -----------------------------------------------------------------------------
$pages['mc-app-mods'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'static_page',
  'instance_id'       => 'mc-app-mods',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'mission-control/desired-application-modifications',
  ],
  'in_section'        => 'mission_control',
  'in_context'        => 'noindex',
];

// -----------------------------------------------------------------------------
$pages['mc-article-ideas'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'static_page',
  'instance_id'       => 'mc-article-ideas',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'mission-control/article-ideas',
  ],
  'in_section'        => 'mission_control',
  'in_context'        => 'noindex',
];


// #############################################################################
// DEVELOPER CONTENT.

// -----------------------------------------------------------------------------
$pages['devel-docs'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'static_page',
  'instance_id'       => 'devel-docs',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'devel/documentation-for-developers',
  ],
  'in_section'        => 'devel',
  'in_context'        => 'noindex,',
];

// -----------------------------------------------------------------------------
$pages['devel-project-1'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'devel-project-1',
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'devel/project-1',
    'secondary' => 'devel/projekt-1',
  ],
  'in_section'        => 'devel',
  'in_context'        => 'noindex',
];

// -----------------------------------------------------------------------------
$pages['devel-comp-demo'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'devel-comp-demo',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'devel/components-demo',
    'secondary' => NULL,
  ],
  'in_section'        => 'devel',
  'in_context'        => 'noindex',
];
