<?php
/**
 * Present agent: image_display_preview.
 */

function pa_image_display_preview(&$args) {
  $args['template_name'] = 'wrap';

  // Wrapper attributes.
  // $args['wrapper_options']['attributes']['class'][] = 'some-class';

  // Adding links to the title and preview_image fields.
  $item = $args['instance_id'];
  if (!empty($args['fetch_locale'])) {
    $path_locale = $args['fetch_locale'];
  }
  else {
    $path_locale = LOCALE_KEY;
  }
  if (!empty($args['flexilist_order']['item_options']['link_items_to_pages'])
      && !empty($GLOBALS['definitions']['pages'][$item])) {

    if (array_key_exists($path_locale, $GLOBALS['definitions']['pages'][$item]['paths'])) {
      $content_path = $GLOBALS['definitions']['pages'][$item]['paths'][$path_locale];
    }
    if (isset($content_path)) {
      $field_link = array(
        'href' => base_path(array('for_locale' => $path_locale)) . $content_path,
      );
      // Link on the preview image.
      if (!empty($args['raw_data']['field_preview_image']['field_content'])) {
        $args['raw_data']['field_preview_image']['link_to'] = $field_link;
        if (!empty($img_alt)) {
          $args['raw_data']['field_preview_image']['field_content']['attributes']['alt'] =
            $img_alt;
        }
      }
    }
  }

  // Image alt attribute.
  // The field_caption is already sanitized by the text-field data-handler.
  $args['raw_data']['field_preview_image']['field_content']['attributes']['alt'] =
    $args['raw_data']['field_caption']['field_content'];
  $args['raw_data']['field_preview_image']['field_content']['attributes']['title'] =
    $args['raw_data']['field_caption']['field_content'];
  unset($args['raw_data']['field_caption']);

  // Keeping only the title and preview-related fields.
  // $fields_to_keep = array(
  //   'field_preview_image',
  //   'field_caption',
  // );
  // foreach($args['raw_data'] as $field_id => $field_data) {
  //   if (!in_array($field_id, $fields_to_keep)) {
  //     unset($args['raw_data'][$field_id]);
  //   }
  // }

  // Pre-rendering fields
  if ($args['data_type'] == 'entity') {
    $args['field_prerenderer_options'] = array(
      'template_variant' => 'essence',
    );
    $args['raw_data'] = templateutils_prerender_fields($args);
  }

  // Implementing assignments.
  $args['variables']['content'] = implode("\n", $args['raw_data']);
}
