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
  $output .= _decd_grids();
  $output .= _decd_typography();
  $output .= _decd_in_text();

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
    'cell-3' => 'Donec viverra augue',
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

Nunc eget commodo sem. Quisque sit amet convallis tortor, nec tempus neque. Vivamus quis nibh a urna auctor dictum id in sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ligula urna, posuere quis viverra id, condimentum et elit.

${table}

Pellentesque est quam, consequat sit amet fermentum at, feugiat commodo enim. Etiam vel eros sit amet magna cursus sodales.

Pellentesque ut augue nisi. Quisque sit amet lorem sem. Vivamus vestibulum sem lacinia, vulputate ex ut, convallis leo. Pellentesque at ex orci. Praesent nec feugiat elit. Donec viverra augue in massa pretium, a tincidunt est dictum. Nulla consequat ante id sem feugiat suscipit. Duis placerat at ipsum non suscipit. Maecenas pretium imperdiet libero, in finibus risus molestie eu.

EOT;

  // Text filter.
  $filter_params = array(
    'text_format' => 'md',
    'data' => $text,
  );
  $demo = datautils_filter($filter_params);

  $output = array(
    'name'        => 'typography',
    'title'       => 'Typography',
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

  $list_1_args = array(
    'order_id' => 'images_all',
  );
  $list_1_opts = array(
    'list_properties_preset' => 'default',
    'presentation_preset'    => 'default',
  );
  $list1 = dh_flexilist($list_1_args, $list_1_opts);

  $list_2_args = array(
    'order_id' => 'images_all',
  );
  $list_2_opts = array(
    'list_properties_preset' => 'matrix-cards',
    'presentation_preset'    => 'matrix-cards',
  );
  $list2 = dh_flexilist($list_2_args, $list_2_opts);

  $demo = '<h3>Matrix, float, 3 col</h3>' . $list1
        . '<h3>Matrix, float, 4 col, card style</h3>' . $list2;

  $output = array(
    'name'        => 'grids',
    'title'       => 'Grids initiative',
    'description' => 'Grids initiative. To be continued.',
    'demo'        => $demo,
  );
  return _decd_template($output);
}