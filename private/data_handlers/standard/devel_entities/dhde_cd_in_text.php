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
function devel_entities_cd_in_text($args) {
  return _decd_in_text();
}


function _decd_in_text() {
  $text = <<<EOT

<h2 class="cd">Hero</h2>

<!--HERO-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.

<!--/HERO-->

<h2 class="cd">High</h2>

<!--HIGH-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.

<!--/HIGH-->

<h2 class="cd">Note</h2>

<!--NOTE-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras dictum, velit sit amet faucibus consequat, felis purus malesuada odio, sit amet tincidunt ante massa eu nibh. Quisque nec ornare massa, in posuere diam.

<!--/NOTE-->

<h2 class="cd">Links</h2>

<!--LINKS-->

Lorem ipsum dolor sit amet, consectetur adipiscing elit.

- [Cras dictum, velit sit amet](#)
- [Faucibus consequat, felis purus](#)
- [Malesuada odio, sit amet](#)

<!--/LINKS-->

<h2 class="cd">Defs</h2>

<!--DESCRIPTION-->

They are actually `<ul>`s, but they are disguied to emulate `<dl>`s - for texts parsed with 'classic' Markdown (which has no support for `<dl>`).

<!--/DESCRIPTION-->

<!--DEFS-->

- Pseudo definition term

  - Description for this thing. Sed fringilla nunc ultricies risus porttitor, a mattis tellus pulvinar.
      - In eu venenatis risus, egestas tincidunt erat.
      - Fusce sed metus felis. Ut quis ultricies massa.
      - Suspendisse potenti. Ut ut eleifend eros, a porttitor eros. Aliquam erat volutpat. Nulla luctus purus non sodales tristique.

- Another "definition term", has some `code` in it

  - Pseudo definition description.
      - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla risus turpis, dapibus sed purus sit amet, malesuada porta odio.
          - Nam dictum nisi quam, `function()` eget finibus dui pellentesque vel. Morbi porttitor velit diam, sit amet ultrices mi luctus non.
              - Quisque a convallis arcu, sit amet porttitor turpis. Phasellus nec metus a orci mollis dignissim id ac purus.

- Pseudo def term numero tre

  - Stuff here. Duis eu lorem a massa condimentum molestie vel sed diam. Aliquam eleifend fringilla nulla, eget sagittis enim luctus non.

      I try to trigger a paragraph here. Fusce suscipit sodales arcu non auctor. Curabitur nisi tellus, faucibus quis vestibulum ut, pharetra quis ipsum.

      - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed ligula in lorem ultricies porta et sed nunc. Lorem ipsum dolor sit amet, consectetur adipiscing elit.

          I try to trigger a paragraph here. Eget imperdiet quam egestas luctus. Nam libero nulla, fringilla sollicitudin metus pellentesque, fermentum mollis massa.

<!--/DEFS-->

<h2 class="cd">Tickets</h2>

<!--DESCRIPTION-->

`<ul>` list items with specific formatting.

<!--/DESCRIPTION-->

<!--TICKETS-->

- List item with ticket-like appearance

  - Description for this ticket. Sed fringilla nunc ultricies risus porttitor, a mattis tellus pulvinar.
      - In eu venenatis risus, egestas tincidunt erat.
      - Fusce sed metus felis. Ut quis ultricies massa.
      - Suspendisse potenti. Ut ut eleifend eros, a porttitor eros. Aliquam erat volutpat. Nulla luctus purus non sodales tristique.

- Another ticketlike ticket: has some `code` in its title

  - Ticket content expansion.
      - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla risus turpis, dapibus sed purus sit amet, malesuada porta odio.
          - Nam dictum nisi quam, `function()` eget finibus dui pellentesque vel. Morbi porttitor velit diam, sit amet ultrices mi luctus non.
              - Quisque a convallis arcu, sit amet porttitor turpis. Phasellus nec metus a orci mollis dignissim id ac purus.

- This has got a longer top-level list item. Curabitur nisi tellus, faucibus quis vestibulum ut, pharetra quis ipsum. Morbi accumsan sapien ut lacus facilisis interdum.

  - Stuff here. Duis eu lorem a massa condimentum molestie vel sed diam. Aliquam eleifend fringilla nulla, eget sagittis enim luctus non.

      I try to trigger a paragraph here. Fusce suscipit sodales arcu non auctor. Curabitur nisi tellus, faucibus quis vestibulum ut, pharetra quis ipsum.
      - Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sed ligula in lorem ultricies porta et sed nunc. Lorem ipsum dolor sit amet, consectetur adipiscing elit.

          I try to trigger a paragraph here. Eget imperdiet quam egestas luctus. Nam libero nulla, fringilla sollicitudin metus pellentesque, fermentum mollis massa.

- Only-title-having ticket

- Another only-title-having ticket

<!--/TICKETS-->

<h2 class="cd">Splitter</h2>

<!--SPLITTER-->
<!--ITEM-->

Nulla scelerisque euismod ex, vel eleifend libero hendrerit non. Morbi cursus, lacus at gravida dignissim, mauris magna tincidunt odio, at hendrerit nisl elit at leo. Proin euismod purus eget sapien cursus volutpat.

<!--/ITEM-->
<!--ITEM-->

Proin elementum ex ante, sit amet blandit leo dictum et. Duis non ex iaculis, tincidunt mi et, egestas augue. Phasellus tempor interdum nisl, quis bibendum risus. Suspendisse vel sollicitudin sem.

<!--/ITEM-->
<!--/SPLITTER-->

EOT;

  // Text filter.
  $filter_params = array(
    'text_format' => 'md',
    'data' => $text,
  );
  $demo = datautils_filter($filter_params);

  return $demo;
}