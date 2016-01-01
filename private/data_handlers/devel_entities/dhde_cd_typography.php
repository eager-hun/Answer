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
function devel_entities_cd_typography($args) {
  return _decd_typography();
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

  $code = '<pre><code>' . htmlspecialchars($example_code) . '</code></pre>';

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

<p id="id-test">HTML id test.</p>

 Integer nec tortor in erat semper tincidunt nec at nibh. Curabitur fermentum tellus nec dui sagittis semper. Nullam tristique aliquet odio. Integer sagittis purus turpis, in sodales lectus ullamcorper vitae.

${definitions_list}

Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi dapibus, justo condimentum accumsan ultrices, augue dolor condimentum sem, vitae vestibulum augue lacus nec lorem. Pellentesque porttitor massa interdum lorem mattis tincidunt. Nulla eget suscipit massa. Cras nec eros velit. Donec vel feugiat tellus.

<blockquote>
  <p>This is a standard blockquote.</p>

  <p>Nunc eget commodo sem. Quisque sit amet convallis tortor, nec tempus neque. Vivamus quis nibh a urna auctor dictum id in sapien. Lorem ipsum dolor sit amet.</p>
</blockquote>

 Integer nec tortor in erat semper tincidunt nec at nibh. Curabitur fermentum tellus nec dui sagittis semper. Nullam tristique aliquet odio. Integer sagittis purus turpis, in sodales lectus ullamcorper vitae.

<h2 class="cd">Table</h2>

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

<h2 class="cd">Preformatted text</h2>

    This preformatted text seems to show not much fancy formatting.

    We must remember though to sample long lines of text here,
    so that we can see how this behaves on narrower screens.

<h2 class="cd">Code</h2>

${code}

EOT;

  // Text filter.
  $filter_params = array(
    'text_format' => 'md',
    'data' => $text,
  );
  $demo = datautils_filter($filter_params);

  return $demo;
}
