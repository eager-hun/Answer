<?php
/**
 * @file
 * Place to define pages for the website.
 */

// -----------------------------------------------------------------------------
$pages['home'] = [
  'data_type'        => 'binder',
  'instance_id'      => 'full_page_prototype', // Id of the payload (binder).
  'present_as'       => 'full_page_prototype', // PA for the payload.
  'template_variant' => 'full_page_prototype', // Id of the page global binder.
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

// -----------------------------------------------------------------------------
$pages['fpp-layouts-demo'] = [
  'data_type'         => 'entity',
  'entity_type'       => 'dynamic',
  'instance_id'       => 'fpp-layouts-demo',
  'meta_descriptions' => [
    'primary'   => NULL,
  ],
  'has_translations'  => 0,
  'paths' => [
    'primary'   => 'layouts-demo',
  ],
  'in_section'        => '',
  'in_context'        => '',
  'xml_sitemap_include' => 1,
];