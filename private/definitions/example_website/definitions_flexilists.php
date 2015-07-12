<?php
/**
 * Flexilist definitions.
 */

// -----------------------------------------------------------------------------
$flexilists['articles_top'] = array(
  'data_type'    => 'entity',
  'entity_type'  => 'article',
  'instance_ids' => array(
    'article-1',
    'article-2',
  ),
  'presets_list_properties' => array(
    // DEFAULT PROPERTIES.
    'default' => array(
      'fetch_fields' => array(
        'field_title',
        'field_preview_text',
        'field_preview_image',
      ),
      'link_items_to_pages' => 1,
    ),
  ),
  'presets_presentation' => array(
    // DEFAULT PRESENTATION.
    'default' => array(
      'present_items_as' => 'article_preview',
      'list_options' => array(
        'attributes' => array(
          'class' => array('l--list-plain'),
        ),
      ),
      'item_options' => array(
        'attributes' => array(
          'class' => array('item'),
        ),
      ),
    ),
  ),
);

// -----------------------------------------------------------------------------
$flexilists['articles_all'] = array(
  'data_type'    => 'entity',
  'entity_type'  => 'article',
  'instance_ids' => array(
    'article-1',
    'article-2',
  ),
  'presets_list_properties' => array(
    // DEFAULT PROPERTIES.
    'default' => array(
      'fetch_fields' => array(
        'field_title',
        'field_preview_text',
        'field_preview_image',
      ),
      'link_items_to_pages' => 1,
    ),
  ),
  'presets_presentation' => array(
    // DEFAULT PRESENTATION.
    'default' => array(
      'present_items_as' => 'article_preview',
      'list_options' => array(
        'attributes' => array(
          'class' => array('l--list-plain'),
        ),
      ),
      'item_options' => array(
        'attributes' => array(
          'class' => array('item'),
        ),
      ),
    ),
  ),
);

// -----------------------------------------------------------------------------
$flexilists['images_all'] = array(
  'data_type'    => 'entity',
  'entity_type'  => 'image_display',
  'instance_ids' => array(
    'test-image-1',
    'test-image-2',
    'test-image-3',
    'test-image-4',
    'test-image-5',
    'test-image-6',
  ),
  // PROPERTIES PRESETS.
  'presets_list_properties' => array(
    'default' => array(
      'fetch_fields' => array(
        'field_preview_image',
        'field_caption',
      ),
      'link_items_to_pages' => 1,
    ),
    'matrix-cards' => array(
      'fetch_fields' => array(
        'field_preview_text',
        'field_preview_image',
      ),
      'link_items_to_pages' => 1,
    ),
    'test' => array(
      'fetch_fields' => array(
        'field_title',
        'field_preview_text',
        'field_preview_image',
      ),
      'link_items_to_pages' => 1,
    ),
  ),
  // PRESENTATION PRESETS.
  'presets_presentation' => array(
    'default' => array(
      'list_HTML_markup' => 'div', // Unimplemented.
      'present_items_as' => 'image_display_preview',
      'list_options' => array(
        'attributes' => array(
          'class' => array(
            'grid',
            'l--matrix',
            'l--matrix--cols-4',
          ),
        ),
      ),
      'item_options' => array(
        'attributes' => array(
          'class' => array(
            'item',
          ),
        ),
      ),
    ),
    '3-cols' => array(
      'list_HTML_markup' => 'div', // Unimplemented.
      'present_items_as' => 'image_display_preview',
      'list_options' => array(
        'attributes' => array(
          'class' => array(
            'grid',
            'l--matrix',
            'l--matrix--cols-3',
          ),
        ),
      ),
      'item_options' => array(
        'attributes' => array(
          'class' => array(
            'item',
          ),
        ),
      ),
    ),
  ),
);
