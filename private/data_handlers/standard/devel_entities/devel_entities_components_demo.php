<?php
/**
 * Custom script for the components_demo devel entity.
 */

/**
 * Standard function.
 *
 * Make its name match the file-name.
 */
function devel_entities_components_demo($args) {
  $output = '';
  $output .= _decd_placeholder();
  $output .= _decd_in_text();

  return $output;
}

/**
 * Return a template for each component/group.
 */
function _decd_template($variables) {
  $name        = ensafe_string($variables['name'], 'attribute_value');
  $title       = ensafe_string($variables['title'], 'html');
  $description = ensafe_string($variables['description'], 'html');
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
    'description' => 'E.g. textboxes, splitters.',
    'demo'        => $demo,
  );
  return _decd_template($output);
}
