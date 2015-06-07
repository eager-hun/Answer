<?php
/**
 * @file
 * Templating functions.
 */

/**
 * Draw plain (Return passed in data without any template around it).
 */
function draw_plain($args) {
  if (!empty($args['variables']['content'])) {
    return $args['variables']['content'];
  }
}

/**
 * Draw a single wrapper around the data.
 *
 * NOTE: this one has a variable wrapper tag.
 * templateutils_present() makes sure there is a default value for it at all
 * times.
 */
function draw_wrap($args) {
  $output = '<' . $args['variables']['wrapper_html_tag']
    . $args['variables']['wrapper_attributes'] . ">\n";
  if (!empty($args['variables']['content'])) {
    $output .= $args['variables']['content'];
  }
  $output .= '</' . $args['variables']['wrapper_html_tag'] . ">\n";
  return $output;
}

/**
 * Draw a field.
 */
function draw_field($args) {
  $buffer = '';

  if (!empty($args['wrapper_options']['template_variant'])) {
    $variant = $args['wrapper_options']['template_variant'];
  }
  else {
    $variant = 'full';
  }

  if ($variant == 'full' && !empty($args['variables']['field_label'])) {
    $buffer .= '<div class="label field__label">'
      . $args['variables']['field_label'] . '</div>';
  }
  if (isset($args['variables']['field_content'])) {
    if ($variant == 'essence' || $variant == 'plain') {
      $buffer .= $args['variables']['field_content'] . "\n";
    }
    else {
      $buffer .= "<div class='field__content'>\n"
        . $args['variables']['field_content'] . "\n</div>\n";
    }
  }
  if ($variant != 'plain') {
    $output = '<div' . $args['variables']['wrapper_attributes'] . ">\n"
            . $buffer . "</div>\n";
  }
  else {
    $output = $buffer;
  }
  return $output;
}

/**
 * Draw a block.
 */
function draw_block($args) {
  $output = '<div' . $args['variables']['wrapper_attributes'] . ">\n";
  if (!empty($args['variables']['block_title'])) {
    $output .= '<div' . $args['variables']['title_attributes'] . ">\n"
      . $args['variables']['block_title'] . "</div>\n";
  }
  if (isset($args['variables']['block_content'])) {
    $output .= "<div class='block__content'>\n"
      . $args['variables']['block_content'] . "</div>\n";
  }
  $output .= "</div>\n";
  return $output;
}

/**
 * Draw link.
 */
function draw_link($args) {
  $output = '<a' . $args['variables']['link_attributes'] . '>'
    . $args['variables']['link_text'] . '</a>';
  return $output;
}

/**
 * Draw menu item.
 */
function draw_menu_item($args) {
  $output = '<li' . $args['variables']['wrapper_attributes'] . '>'
          . '<a' . $args['variables']['link_attributes'] . '><span>'
          . $args['variables']['link_text'] . '</span></a>'
          . $args['variables']['element_children'] . "</li>\n";
  return $output;
}

/**
 * Draw static menu item.
 */
function draw_static_menu_item($args) {
  // FIXME: the span.menu__static should receive its classes through $args too!
  $output = '<li' . $args['variables']['wrapper_attributes'] . '>'
    . '<span class="menu__static menu__button"><span>'
    . $args['variables']['item_text'] . '</span></span>'
    . $args['variables']['element_children'] . "</li>\n";
  return $output;
}

/**
 * Draw langswitch unit.
 */
function draw_langswitch_unit($args) {
  $output = '<div' . $args['variables']['wrapper_attributes'] . '>';
    if (!empty($args['variables']['pretext'])) {
      $output .= $args['variables']['pretext'];
    }
    $output .= $args['variables']['items'] . '</div>';
  return $output;
}

/**
 * Draw langswitch link.
 */
function draw_langswitch_link($args) {
  $output = '<a' . $args['variables']['link_attributes'] . '>';
  if (!empty($args['langswitch_type'])) {
    $output .= '<span class="flag"></span>';
    // $output .= '<span class="text">' . $args['variables']['link_text'] . '</span>';
  }
  else {
    $output .= '<span class="text">' . $args['variables']['link_text'] . '</span>';
  }
  $output .= '</a>';
  return $output;
}

/**
 * Draw image.
 */
function draw_image($args) {
  $output = '<img' . $args['variables']['attributes'] . ">\n";
  return $output;
}

/**
 * Draw content metadata readout.
 */
function draw_content_meta($args) {
  $output = '';
  if (!empty($args['variables']['page_title'])) {
    $output .= '<h1 class="page__title">' . $args['variables']['page_title'] . '</h1>';
  }
  if (!empty($args['variables']['page_subtitle'])) {
    $output .= '<div class="page__subtitle">' . $args['variables']['page_subtitle'] . '</div>';
  }
  if (!empty($args['variables']['date_created'])
      || !empty($args['variables']['date_lastmod'])
      || !empty($args['variables']['langswitch_page'])) {
    $output .= '<div class="content-meta__info">';
    if (!empty($args['variables']['date_created'])) {
      $output .= '<div class="content-meta__item doc-meta--created">'
        . $args['variables']['date_created'] . '</div>';
    }
    if (!empty($args['variables']['date_lastmod'])) {
      $output .= '<div class="content-meta__item doc-meta--lastmod">'
        . $args['variables']['date_lastmod'] . '</div>';
    }
    $output .= "</div><!-- /.content-meta__info -->\n";
  }
  return $output;
}

/**
 * Draw HTML document.
 */
function draw_html_document($args) {
  $output = "<!DOCTYPE html>\n";
  $output .= '<html' . $args['variables']['html_attributes'] . ">\n";
  if (!empty($args['variables']['head_content'])) {
    $output .= '<head' . $args['variables']['head_attributes'] . ">\n"
             . $args['variables']['head_content'] . "</head>\n";
  }
  if (!empty($args['variables']['body'])) {
    // The body variable already contains the <body> element as wrapper.
    $output .= $args['variables']['body'];
  }
  $output .= '</html>';
  return $output;
}
