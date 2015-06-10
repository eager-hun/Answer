<?php
/**
 * Custom script for the components_demo devel entity.
 */

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
  $output .= _decd_in_text();
  $output .= _decd_grids();

  return $output;
}

/**
 * Return a template for each component/group.
 */
function _decd_template($variables) {

  // Preparing for rendering inputs that were received as markdown.
  $parse_title = array(
    'text_format' => 'md',
    'data' => $variables['title'],
  );
  $parse_description = array(
    'text_format' => 'md',
    'data' => $variables['description'],
  );

  $name        = ensafe_string($variables['name'], 'attribute_value');
  $title       = datautils_filter($parse_title);
  $description = datautils_filter($parse_description);
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
    'title'       => 'Component demo placeholder',
    'description' => 'Placeholder description.',
    'demo'        => $demo,
  );
  return _decd_template($output);
}

/**
 * In-text features.
 */
function _decd_in_text() {
  $text = <<<EOT

### Hero:

<!--HERO-->
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.
<!--/HERO-->

### High:

<!--HIGH-->
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.
<!--/HIGH-->

### Note:

<!--NOTE-->
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.
<!--/NOTE-->

### Links:

<!--LINKS-->
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.
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
    'title'       => 'In-text components',
    'description' => 'E.g. textboxes, splitters.<br>These already are, or can be made available as "short tags" (configured in `config.php`)',
    'demo'        => $demo,
  );
  return _decd_template($output);
}

/**
 * Grids.
 */
function _decd_grids() {

  apputils_wake_resource('data_handler', 'flexilist');

  $flexilist_1_args = array(
    'order_id' => 'images_all',
  );
  $flexilist_1_opts = array(
    'list_properties_preset' => 'default',
    'presentation_preset'    => 'default',
  );
  $list1 = dh_flexilist($flexilist_1_args, $flexilist_1_opts);

  // $flexilist_2_args = array(
  //   'order_id' => 'images_all',
  // );
  // $flexilist_2_opts = array(
  //   'list_properties_preset' => 'testing-props',
  //   'presentation_preset'    => 'testing-prez',
  // );
  // $list2 = dh_flexilist($flexilist_2_args, $flexilist_2_opts);

  $demo = '<h3>Test list 1</h3>' . $list1;
     // . '<h3>Test list 2</h3>' . $list2;

  $output = array(
    'name'        => 'grids',
    'title'       => 'Grids initiative',
    'description' => 'Grids initiative. To be continued.',
    'demo'        => $demo,
  );
  return _decd_template($output);
}