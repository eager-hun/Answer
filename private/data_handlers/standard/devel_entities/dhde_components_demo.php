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
$GLOBALS['config']['ui']['js_body'][] = array(
  'source' => 'frontend_library',
  'file'   => 'slick.js/slick/slick.min.js',
);
$GLOBALS['config']['ui']['js_body'][] = array(
  'source' => 'theme',
  'file'   => 'components-demo.js',
);
$GLOBALS['config']['ui']['css_external'][] = array(
  'source' => 'frontend_library',
  'file'   => 'slick.js/slick/slick.css',
);
$GLOBALS['config']['ui']['css_external'][] = array(
  'source' => 'frontend_library',
  'file'   => 'slick.js/slick/slick-theme.css',
);
$GLOBALS['config']['ui']['css_external'][] = array(
  'source' => 'theme_generated',
  'file'   => 'extra_components_demo.css',
);


/**
 * Standard function.
 *
 * Make its name match the file-name.
 *
 * @return string
 *   The complete rendered components demo series.
 */
function devel_entities_components_demo($args) {
  $output = '';
  $output .= _decd_grids();
  $output .= _decd_carousels();
  $output .= _decd_typography();
  $output .= _decd_in_text();

  return $output;
}

/**
 * Return a template for each component/group.
 */
function _decd_template($variables) {

  // Preparing for rendering inputs that were received as markdown.
  $title       = NULL;
  $description = NULL;
  if (!empty($variables['title'])) {
    $parse_title = array(
      'text_format' => 'md',
      'data' => $variables['title'],
    );
    $title = datautils_filter($parse_title);
  }
  if (!empty($variables['description'])) {
    $parse_description = array(
      'text_format' => 'md',
      'data' => $variables['description'],
    );
    $description = datautils_filter($parse_description);
  }
  $name        = ensafe_string($variables['name'], 'attribute_value');
  $demo        = $variables['demo'];

  $output = '<div class="component-demo cd--' . $name . '">';
  $output .= '<h2 class="cd__title">' . $title . '</h2>';
  $output .= '<div class="description cd__description">' . $description . '</div>';
  $output .= '<div class="cd__demo">' . $demo . '</div>';
  $output .= '</div>';

  return $output;
}

/**
 * Placeholder demo.
 */
function _decd_placeholder() {
  $demo = '<p>Placeholding.</p>';

  $output = array(
    'name'        => 'placeholder',
    'title'       => '<span class="anchor" id="anchor--placeholder"></span>Component demo placeholder',
    'description' => 'Placeholder description.',
    'demo'        => $demo,
  );
  return _decd_template($output);
}

/**
 * Typography.
 */
function _decd_typography() {

  // Preparing a definitions list, because the original markdown can't help with
  // that.
  $ditem = array(
    'dt' => 'Definition term',
    'dd' => 'Definition description, such as praesent nec feugiat elit. Donec viverra augue in massa pretium, a tincidunt est dictum.',
  );
  $definitions_list = "<dl>\n";
  for ($i = 0; $i < 4; $i++) {
    $definitions_list .= '<dt>' . $ditem['dt'] . "</dt>\n"
         . '<dd>' . $ditem['dd'] . "</dd>\n";
  }
  $definitions_list .= "</dl>\n";

  // Preparing a table, because the original markdown can't help with that.
  $theads = array(
    'thead-1' => 'Thead 1',
    'thead-2' => 'Thead 2',
    'thead-3' => 'Thead 3',
    'thead-4' => 'Thead 4',
    'thead-5' => 'Thead 5',
  );
  $cells = array(
    'cell-1' => 'Cell 1',
    'cell-2' => 'Cell 2 praesent nec feugiat elit',
    'cell-3' => 'Vivamus quis nibh a urna auctor dictum id in sapien.',
    'cell-4' => '42',
    'cell-5' => 'Sed vehicula nunc at augue lacinia',
  );
  $table = "<table>\n";
  for ($i = 0; $i < 6; $i++) {
    $row = '';
    if ($i == 0) {
      $table .= "<thead>\n";
      foreach ($theads as $thead) {
        $row .= '<th>' . $thead . "</th>\n";
      }
      unset($thead);
      $table .= "<tr>\n" . $row . "</tr>\n";
      $table .= "</thead>\n";
    }
    else {
      if ($i == 1) {
        $table .= "<tbody>\n";
      }
      foreach ($cells as $cell) {
        $row .= '<td>' . $cell . "</td>\n";
      }
      unset($cell);
      $table .= "<tr>\n" . $row . "</tr>\n";
    }
  }
  $table .= "</tbody>\n</table>\n";

  // Code needs to be escaped.
  $example_code = <<<EOT
<body<?php print \$variables['wrapper_attributes']; ?>>

  <?php if (!empty(\$variables['slot_body_start'])): ?>
    <?php print \$variables['slot_body_start']; ?>
  <?php endif; ?>

  <?php if (!empty(\$variables['slot_page_content'])): ?>
    <div class="page-content">
      <?php print \$variables['slot_page_content']; ?>
    </div>
  <?php endif; ?>

  <?php if (!empty(\$variables['slot_body_end'])): ?>
    <?php print \$variables['slot_body_end']; ?>
  <?php endif; ?>

</body>
EOT;

  $pre = '<pre><code>' . htmlspecialchars($example_code) . '</code></pre>';

  $text = <<<EOT

# Heading type one

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in malesuada leo. Aenean elementum dictum mauris nec venenatis. Sed vehicula nunc at augue lacinia, vel cursus ligula interdum. Vivamus ut augue viverra, luctus leo a, mattis orci.

Sed a libero ut nunc fringilla gravida vel ut nibh. Ut et condimentum tellus. Donec dolor magna, vestibulum non ipsum eget, ultricies lobortis orci. Donec sit amet neque pretium, elementum ligula eu, maximus nisi.

## Heading type two

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in malesuada leo. Aenean elementum dictum mauris nec venenatis. Sed vehicula nunc at augue lacinia, vel cursus ligula interdum. Vivamus ut augue viverra, luctus leo a, mattis orci.

Sed a libero ut nunc fringilla gravida vel ut nibh. Ut et condimentum tellus. Donec dolor magna, vestibulum non ipsum eget, ultricies lobortis orci. Donec sit amet neque pretium, elementum ligula eu, maximus nisi.

### Heading type three

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in malesuada leo. Aenean elementum dictum mauris nec venenatis. Sed vehicula nunc at augue lacinia, vel cursus ligula interdum. Vivamus ut augue viverra, luctus leo a, mattis orci.

Sed a libero ut nunc fringilla gravida vel ut nibh. Ut et condimentum tellus. Donec dolor magna, vestibulum non ipsum eget, ultricies lobortis orci. Donec sit amet neque pretium, elementum ligula eu, maximus nisi.

#### Heading type four

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in malesuada leo. Aenean elementum dictum mauris nec venenatis. Sed vehicula nunc at augue lacinia, vel cursus ligula interdum. Vivamus ut augue viverra, luctus leo a, mattis orci.

Sed a libero ut nunc fringilla gravida vel ut nibh. Ut et condimentum tellus. Donec dolor magna, vestibulum non ipsum eget, ultricies lobortis orci. Donec sit amet neque pretium, elementum ligula eu, maximus nisi.

##### Heading type five

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in malesuada leo. Aenean elementum dictum mauris nec venenatis. Sed vehicula nunc at augue lacinia, vel cursus ligula interdum. Vivamus ut augue viverra, luctus leo a, mattis orci.

Sed a libero ut nunc fringilla gravida vel ut nibh. Ut et condimentum tellus. Donec dolor magna, vestibulum non ipsum eget, ultricies lobortis orci. Donec sit amet neque pretium, elementum ligula eu, maximus nisi.

###### Heading type six

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut in malesuada leo. Aenean elementum dictum mauris nec venenatis. Sed vehicula nunc at augue lacinia, vel cursus ligula interdum. Vivamus ut augue viverra, luctus leo a, mattis orci.

Sed a libero ut nunc fringilla gravida vel ut nibh. Ut et condimentum tellus. Donec dolor magna, vestibulum non ipsum eget, ultricies lobortis orci. Donec sit amet neque pretium, elementum ligula eu, maximus nisi.

- Sed a libero ut nunc fringilla gravida vel ut nibh. Ut et condimentum tellus. Donec dolor magna.
- Vestibulum non ipsum eget, ultricies lobortis orci.
  - Donec sit amet neque pretium, elementum ligula eu, maximus nisi.
  - Aliquam facilisis odio sed fermentum molestie. Cras a lorem ac odio hendrerit.
- Lorem ipsum dolor sit amet, consectetur adipiscing elit.
  - Lacinia id nec tortor. Cras sagittis luctus odio, non sollicitudin sapien consequat ut.
- Morbi lectus arcu, porta id mattis a, egestas sit amet lorem.

Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus convallis lectus elit, et posuere nunc tempus id. Suspendisse at scelerisque ligula, ut sollicitudin nulla. In ut pharetra nulla. Quisque quis justo in sem efficitur elementum.


1. Integer dapibus, mi eget efficitur dictum,
2. diam ligula cursus arcu, vel ultricies nulla arcu sed nibh,
3. proin vulputate rhoncus metus sed tempor,
  - aliquam efficitur maximus ex et tincidunt,
  - sed odio odio, rhoncus et ex eu,
  - tincidunt consectetur ligula. Phasellus pharetra turpis.
4. Non velit dictum, eu auctor arcu sollicitudin.
   - sed imperdiet mi fermentum elit.
5. Nunc sagittis volutpat ultrices. Nam consequat massa ligula.

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam pretium accumsan neque sit amet aliquam. Curabitur a purus euismod nibh laoreet commodo. Etiam tincidunt felis posuere, tincidunt nisl pretium, congue ligula. Fusce nunc est, aliquet eu ipsum vitae, finibus laoreet ex.

 Integer nec tortor in erat semper tincidunt nec at nibh. Curabitur fermentum tellus nec dui sagittis semper. Nullam tristique aliquet odio. Integer sagittis purus turpis, in sodales lectus ullamcorper vitae.

${definitions_list}

Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi dapibus, justo condimentum accumsan ultrices, augue dolor condimentum sem, vitae vestibulum augue lacus nec lorem. Pellentesque porttitor massa interdum lorem mattis tincidunt. Nulla eget suscipit massa. Cras nec eros velit. Donec vel feugiat tellus.

<blockquote>
  <p>This is a standard blockquote.</p>

  <p>Nunc eget commodo sem. Quisque sit amet convallis tortor, nec tempus neque. Vivamus quis nibh a urna auctor dictum id in sapien. Lorem ipsum dolor sit amet.</p>
</blockquote>

 Integer nec tortor in erat semper tincidunt nec at nibh. Curabitur fermentum tellus nec dui sagittis semper. Nullam tristique aliquet odio. Integer sagittis purus turpis, in sodales lectus ullamcorper vitae.

### Table

Tables are advised to have a `div.table__wrap` protector element around them
when they occur in the content, to prevent tables from dangling out of their
column.

- [https://github.com/sniku/jQuery-doubleScroll/](https://github.com/sniku/jQuery-doubleScroll) may be of simple help,
- [https://datatables.net/extensions/responsive/](https://datatables.net/extensions/responsive/) may be of advanced help.

<div class="table__wrap">
  ${table}
</div>

Pellentesque est quam, consequat sit amet fermentum at, feugiat commodo enim. Etiam vel eros sit amet magna cursus sodales.

Pellentesque ut augue nisi. Quisque sit amet lorem sem. Vivamus vestibulum sem lacinia, vulputate ex ut, convallis leo. Pellentesque at ex orci. Praesent nec feugiat elit. Donec viverra augue in massa pretium, a tincidunt est dictum.

---

Nulla consequat ante id sem feugiat suscipit. Duis placerat at ipsum non suscipit. Maecenas pretium imperdiet libero, in finibus risus molestie eu.

Pellentesque ut augue nisi. Quisque sit amet lorem sem. Vivamus vestibulum sem lacinia, vulputate ex ut, convallis leo. Pellentesque at ex orci. Praesent nec feugiat elit. Donec viverra augue in massa pretium, a tincidunt est dictum.

### Preformatted text

    This preformatted text seems to show not much fancy formatting.

    We must remember though to sample long lines of text here,
    so that we can see how this behaves on narrower screens.

### Code

${pre}

EOT;

  // Text filter.
  $filter_params = array(
    'text_format' => 'md',
    'data' => $text,
  );
  $demo = datautils_filter($filter_params);

  $output = array(
    'name'        => 'typography',
    'title'       => '<span class="anchor" id="anchor--typography"></span>Typography',
    'description' => 'A basic overview.',
    'demo'        => $demo,
  );
  return _decd_template($output);
}

/**
 * In-text features.
 */
function _decd_in_text() {
  $text = <<<EOT

### Hero

<!--HERO-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.

<!--/HERO-->

### High

<!--HIGH-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.

<!--/HIGH-->

### Note

<!--NOTE-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.

<!--/NOTE-->

### Links

<!--LINKS-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit.

- [Cras dictum, velit sit amet](#)
- [Faucibus consequat, felis purus](#)
- [Malesuada odio, sit amet](#)

<!--/LINKS-->

EOT;

  // Text filter.
  $filter_params = array(
    'text_format' => 'md',
    'data' => $text,
  );
  $demo = datautils_filter($filter_params);

  $output = array(
    'name'        => 'in-text',
    'title'       => '<span class="anchor" id="anchor--in-text"></span>In-text components',
    'description' => 'E.g. textboxes, splitters.<br>These already are, or can be made available as "short tags" (configured in `config.php`)',
    'demo'        => $demo,
  );
  return _decd_template($output);
}

/**
 * Grids.
 */
function _decd_grids() {
  $registry = $GLOBALS['registry'];

  apputils_wake_resource('data_handler', 'flexilist');

  // List 1.
  $list_1_args = array(
    'order_id' => 'images_all',
  );
  $list_1_opts = array(
    'list_properties_preset' => 'default',
    'presentation_preset'    => 'default',
  );
  $list_1 = dh_flexilist($list_1_args, $list_1_opts);

  // List 2.
  $list_2_args = array(
    'order_id' => 'images_all',
  );
  $list_2_opts = array(
    'list_properties_preset' => 'matrix-cards',
    'presentation_preset'    => 'matrix-cards',
  );
  $list_2 = dh_flexilist($list_2_args, $list_2_opts);

  // Fabricating "Feature highlight"s.
  $feature_highlight_template = $registry['app_current']['templates']
    . '/layouts/layout_feature_highlight/layout_feature_highlight.template.php';
  $image_style = '1_1-270w';
  $image_path_base = $registry['app_externals']['document_files']
                   . '/images/' . $image_style . '/';

  $fh_list__items = $GLOBALS['temp']['dh_devel_entities']['cd_dummies']['dummy_list'];
  $fh_list__rendered_items = array();

  foreach ($fh_list__items as $item) {
    $image_attributes = array(
      'src' => $image_path_base . ensafe_string($item['image'], 'file_name'),
      'title' => ensafe_string($item['title']),
    );
    $image_template = array(
      'template_name' => 'image',
      'variables'     => array(
        'attributes'  => templateutils_render_html_attributes($image_attributes),
      ),
    );
    $link_attributes = array(
      'href' => $item['button_url'],
    );
    $link_template = array(
      'template_name' => 'link',
      'variables' => array(
        'link_attributes' => templateutils_render_html_attributes($link_attributes),
        'link_text'       => ensafe_string($item['button_text']),
      ),
    );
    $item_attributes = array(
      'class' => array(
        'item',
        'tpl--feature_highlight',
      ),
    );
    $variables = array(
      'wrapper_attributes' => templateutils_render_html_attributes($item_attributes),
      'slot_image'  => templateutils_present($image_template),
      'slot_title'  => ensafe_string($item['title'], 'html'),
      'slot_text'   => ensafe_string($item['short_text'], 'html'),
      'slot_button' => templateutils_present($link_template),
    );
    ob_start();
    include $feature_highlight_template;
    $fh_list__rendered_items[] = ob_get_clean();
  }
  unset($item);

  $fh_list_all_items = implode("\n", $fh_list__rendered_items);
  $fh_list_2_items   = implode("\n", array_slice($fh_list__rendered_items, 0, 2));

  $list_3 = '<div class="l--flexbox l--flexbox--auto-row">';
  $list_3 .= $fh_list_2_items;
  $list_3 .= '</div>';

  $list_4 = '<div class="l--flexbox l--flexbox--cols-3">';
  $list_4 .= $fh_list_all_items;
  $list_4 .= '</div>';

  $demo = '<h3>Matrix, float, 3 col</h3>' . $list_1
        . '<h3>Matrix, float, 4 col, card style</h3>' . $list_2
        . '<h3>Flexbox single row "auto stuffer", with <code>display: table;</code> fallback</h3>'
        . '<p class="description">Listed items are "Feature highlight" components.</p>'
        . $list_3
        . '<h3>Flexbox 3-col multi row, with floated grid fallback</h3>'
        . '<p class="description">Listed items are "Feature highlight" components.</p>'
        . $list_4;

  $output = array(
    'name'        => 'grids',
    'title'       => '<span class="anchor" id="anchor--grids"></span>Grid- and Flexbox layouts',
    // 'description' => 'Grid- and Flexbox layouts.',
    'demo'        => $demo,
  );
  return _decd_template($output);
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
    $text = ensafe_string($slide['short_text'], 'html');
    $car_1_img = '<img src="'
         . $car_1_image_path_base . ensafe_string($slide['image'], 'file_name') . '">';
    $car_2_img = '<img src="'
         . $car_2_image_path_base . ensafe_string($slide['image'], 'file_name') . '">';
    $button = '<a class="button" href="' . ensafe_string($slide['button_url']) . '">'
            . ensafe_string($slide['button_text']) . '</a>';
    $index = ensafe_string($index, 'attribute_value');
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

  $demo = $car_1 . $car_2 . $car_3 . $car_4;

  $output = array(
    'name'        => 'carousels',
    'title'       => '<span class="anchor" id="anchor--carousels"></span>Carousels',
    // 'description' => '',
    'demo'        => $demo,
  );
  return _decd_template($output);
}
