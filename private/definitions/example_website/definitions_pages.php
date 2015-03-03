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
// DEPRECATED CONTENT.

// -----------------------------------------------------------------------------
$pages['deprecated-article-3'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'article',
  'instance_id'       => 'deprecated-article-3',
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
$pages['operating-manual'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'generic',
  'instance_id'       => 'operating-manual',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'operating-manual',
  ],
  'in_section'        => '',
  'in_context'        => 'noindex,',
];

// -----------------------------------------------------------------------------
$pages['article-ideas'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'generic',
  'instance_id'       => 'article-ideas',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'article-ideas',
  ],
  'in_section'        => '',
  'in_context'        => 'noindex',
];

// -----------------------------------------------------------------------------
$pages['site-structure-planning'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'generic',
  'instance_id'       => 'site-structure-planning',
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'site-structure-planning',
  ],
  'in_section'        => '',
  'in_context'        => 'noindex',
];


// #############################################################################
// DEVELOPER CONTENT.

// -----------------------------------------------------------------------------
$pages['devel-blank-sheet'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'devel-blank-sheet',
  'has_translations'  => 1,
  'paths' => [
    'primary'   => 'devel/blank-sheet',
    'secondary' => 'devel/ures-lap',
  ],
  'in_section'        => '',
  'in_context'        => 'noindex',
];
