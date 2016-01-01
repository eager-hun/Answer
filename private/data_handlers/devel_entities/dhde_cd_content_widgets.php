<?php
/**
 * Custom script for the components_demo devel entity.
 */


// #############################################################################
// Actions upon inclusion.

$helpers_file = dirname(__FILE__) . '/dhde_cd_helpers.php';
if (file_exists($helpers_file)) {
  include_once($helpers_file);
}
if (function_exists('_dhde_create_dummy_list')) {
  _dhde_create_dummy_list();
}

// Assets.
// @ingroup not_sophisticated, I know.
$GLOBALS['config']['ui']['js_body_regular'][] = array(
  'source'     => 'frontend_library',
  'file'       => 'slick.js/slick/slick.min.js',
  'is_enabled' => 1,
);
$GLOBALS['config']['ui']['js_body_regular'][] = array(
  'source'     => 'theme',
  'file'       => 'components-demo.js',
  'is_enabled' => 1,
);
$GLOBALS['config']['ui']['css_external'][] = array(
  'source'     => 'frontend_library',
  'file'       => 'slick.js/slick/slick.css',
  'is_enabled' => 1,
);
$GLOBALS['config']['ui']['css_external'][] = array(
  'source'     => 'frontend_library',
  'file'       => 'slick.js/slick/slick-theme.css',
  'is_enabled' => 1,
);
$GLOBALS['config']['ui']['css_external'][] = array(
  'source'     => 'theme_generated',
  'file'       => 'extra_components_demo.css',
  'is_enabled' => 1,
);


/**
 * Standard function.
 *
 * Make its name match the file-name.
 *
 * @return string
 *   The complete rendered components demo series.
 */
function devel_entities_cd_content_widgets($args) {
  $output = '';
  $output .= _decd_carousels();
  // $output .= _decd_collapsibles();
  return $output;
}

/**
 * Carousels.
 */
function _decd_carousels() {
  $registry = $GLOBALS['registry'];
  $slides_raw = $GLOBALS['temp']['dh_devel_entities']['cd_dummies']['dummy_list'];

  $car_1_image_style = '3_1-800w';
  $car_1_image_path_base = $registry['app_externals']['document_files']
                   . '/images/' . $car_1_image_style . '/';
  $car_2_image_style = '4_3-400w';
  $car_2_image_path_base = $registry['app_externals']['document_files']
                   . '/images/' . $car_2_image_style . '/';

  $car_1_slides_rendered = array();
  $car_2_slides_rendered = array();

  foreach ($slides_raw as $index => $slide) {
    $text = escape_value($slide['short_text'], 'html');
    $car_1_img = '<img src="'
         . $car_1_image_path_base . escape_value($slide['image'], 'file_name') . '">';
    $car_2_img = '<img src="'
         . $car_2_image_path_base . escape_value($slide['image'], 'file_name') . '">';
    $button = '<a class="button" href="'
            . escape_value($slide['button_action'], 'href') . '">'
            . escape_value($slide['button_text']) . '</a>';
    $index = escape_value($index, 'attribute_value');
    $car_1_rendered_item = <<<EOT
<div class="slide" data-slide-number="${index}">
  <div class="slot--image">${car_1_img}</div>
  <div class="slot--text">${text}</div>
</div>
EOT;
    $car_2_rendered_item = <<<EOT
<div class="slide" data-slide-number="${index}">
  <div class="slot--image">${car_2_img}</div>
  <div class="slot--button">${button}</div>
</div>
EOT;
    $car_1_slides_rendered[] = $car_1_rendered_item;
    $car_2_slides_rendered[] = $car_2_rendered_item;
  }
  unset($slide);

  $car_1 = "<div class=\"crsl__wrap crsl--single__wrap\">\n"
         . "<div class=\"crsl crsl--single crsl--img-bg crsl--cd-1\">\n"
         . implode("\n", $car_1_slides_rendered) . "\n</div>\n</div>\n";

  $car_2 = "<div class=\"crsl__wrap crsl--multi__wrap\">\n"
         . "<div class=\"crsl crsl--multi crsl--cd-2\">\n"
         . implode("\n", $car_2_slides_rendered) . "\n</div>\n</div>\n";

  // Reusing the previous outputs for a combined one.
  $car_3 = "<div class=\"crsl__wrap crsl--single__wrap crsl--paged__wrap\">\n"
         . "<div class=\"crsl crsl--single crsl--paged crsl--cd-3\">\n"
         . implode("\n", $car_1_slides_rendered) . "\n</div>\n</div>\n";

  $car_4 = "<div class=\"crsl__wrap crsl--multi__wrap crsl--pager__wrap\">\n"
         . "<div class=\"crsl crsl--multi crsl--pager  crsl--cd-4\">\n"
         . implode("\n", $car_2_slides_rendered) . "\n</div>\n</div>\n";

  $carousels_intro = <<<EOT
<h2 class="cd">Carousels</h2>

<!--DESCRIPTION-->

The following carousels use the [Slick](http://kenwheeler.github.io/slick/) library.

<!--/DESCRIPTION-->
EOT;

  $demo = datautils_process_markdown($carousels_intro)
        . $car_1 . $car_2 . $car_3 . $car_4;

  return $demo;
}

/**
 * Collapsibles.
 */
function _decd_collapsibles() {
  $collapsibles_intro = <<<EOT
## Dropdowns, collapsibles, accordions

TODO.

EOT;

  $demo = datautils_process_markdown($collapsibles_intro);

  return $demo;
}
