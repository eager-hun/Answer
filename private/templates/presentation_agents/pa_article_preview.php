<?php
/**
 * Present agent: article_preview.
 */

function pa_article_preview(&$args) {
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
  if (!empty($args['flexilist_order']['link_items_to_pages'])
      && !empty($GLOBALS['definitions']['pages'][$item])) {
    if (array_key_exists($path_locale, $GLOBALS['definitions']['pages'][$item]['paths'])) {
      $content_path = $GLOBALS['definitions']['pages'][$item]['paths'][$path_locale];
    }
    if (isset($content_path)) {
      $field_link = array(
        'href' => base_path(array('for_locale' => $path_locale)) . $content_path,
      );
      // Link on the title.
      if (!empty($args['raw_data']['field_title'])) {
        $field_link['title'] = loc('Jump to the following') . ': '
          . ensafe_string($args['raw_data']['field_title']['field_content']);
        $img_alt = loc('Preview image for') . ': '
          . $args['raw_data']['field_title']['field_content'];
        $args['raw_data']['field_title']['link_to'] = $field_link;
      }
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

  // Keeping only the title and preview-related fields.
  $fields_to_keep = array(
    'field_title',
    'field_preview_text',
    // 'field_preview_image', // TODO: It needs a dedicated presentation_agent.
  );
  foreach($args['raw_data'] as $field_id => $field_data) {
    if (!in_array($field_id, $fields_to_keep)) {
      unset($args['raw_data'][$field_id]);
    }
  }

  // Pre-rendering fields
  if ($args['data_type'] == 'entity') {
    $args['field_prerenderer_options'] = array(
      'template_variant' => 'nolabel',
    );
    $args['raw_data'] = templateutils_prerender_fields($args);
  }

  // Implementing assignments.
  $args['variables']['content'] = implode("\n", $args['raw_data']);
}
