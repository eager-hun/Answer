<?php
/**
 * Flexilist definitions.
 */

// -----------------------------------------------------------------------------
$flexilists['articles_top'] = array(
  'data_type'    => 'entity',
  'entity_type'  => 'article',
  'fetch_fields' => array(
    'field_title',
    'field_preview_text',
    'field_preview_image',
  ),
  'instance_ids' => array(
    'article-1',
    'article-2',
  ),
  'present_items_as' => 'article_preview',
  'list_options' => array(
    'attributes' => array(
      'class' => array('fl--style-plain'),
    ),
  ),
  'item_options' => array(
    'link_items_to_pages' => 1,
    'attributes' => array(
      'class' => array('fl-item--standard'),
    ),
  ),
);

// -----------------------------------------------------------------------------
$flexilists['articles_all'] = array(
  'data_type'    => 'entity',
  'entity_type'  => 'article',
  'fetch_fields' => array(
    'field_title',
    'field_preview_text',
    'field_preview_image',
  ),
  'instance_ids' => array(
    'article-1',
    'article-2',
  ),
  'present_items_as' => 'article_preview',
  'list_options' => array(
    'attributes' => array(
      'class' => array('fl--style-plain'),
    ),
  ),
  'item_options' => array(
    'link_items_to_pages' => 1,
    'attributes' => array(
      'class' => array('fl-item--standard'),
    ),
  ),
);

// -----------------------------------------------------------------------------
$flexilists['images_all'] = array(
  'data_type'    => 'entity',
  'entity_type'  => 'image_display',
  'fetch_fields' => array(
    'field_preview_image',
    'field_caption',
  ),
  'instance_ids' => array(
    'test-image-1',
    'test-image-2',
    'test-image-3',
    'test-image-4',
    'test-image-5',
    'test-image-6',
  ),
  'present_items_as' => 'image_display_preview',
  'list_options' => array(
    'attributes' => array(
      'class' => array('fl--style-gallery-cards','grid'),
    ),
  ),
  'item_options' => array(
    'link_items_to_pages' => 1,
    'attributes' => array(
      'class' => array('item'),
    ),
  ),
);
