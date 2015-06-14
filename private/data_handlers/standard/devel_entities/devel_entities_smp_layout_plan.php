<?php
/**
 * @file
 * Provides easy access to variants of .l--2sb, the main page content layout.
 */

/**
 * Standard function.
 *
 * Make its name match the file-name.
 */
function devel_entities_smp_layout_plan($args) {

  $output = "<br><h2>.l--2sb layout variants and states</h2>";

  // ###########################################################################
  // Content-in-mid.

  // Only sidebar 1.
  $output .= <<<EOT
<div class="grid l--2sb content-in-mid has-1-sb sb-1">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_1">
    sidebar_1
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // Only sidebar 2.
  $output .= <<<EOT
<div class="grid l--2sb content-in-mid has-1-sb sb-2">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_2">
    sidebar_2
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // Both sidebars.
  $output .= <<<EOT
<div class="grid l--2sb content-in-mid has-2-sb">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_1">
    sidebar_1
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_2">
    sidebar_2
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // ###########################################################################
  // Content on left.

  // Only sidebar 1.
  $output .= <<<EOT
<div class="grid l--2sb content-on-left has-1-sb sb-1">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_1">
    sidebar_1
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // Only sidebar 2.
  $output .= <<<EOT
<div class="grid l--2sb content-on-left has-1-sb sb-2">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_2">
    sidebar_2
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // Both sidebars.
  $output .= <<<EOT
<div class="grid l--2sb content-on-left has-2-sb">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_1">
    sidebar_1
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_2">
    sidebar_2
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // ###########################################################################
  // Content on right.

  // Only sidebar 1.
  $output .= <<<EOT
<div class="grid l--2sb content-on-right has-1-sb sb-1">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_1">
    sidebar_1
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // Only sidebar 2.
  $output .= <<<EOT
<div class="grid l--2sb content-on-right has-1-sb sb-2">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_2">
    sidebar_2
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  // Both sidebars.
  $output .= <<<EOT
<div class="grid l--2sb content-on-right has-2-sb">

  <div class="g__item column col--main">
    main
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_1">
    sidebar_1
    <div class="dummy-content"></div>
  </div>

  <div class="g__item column col--sidebar col--sb_2">
    sidebar_2
    <div class="dummy-content"></div>
  </div>

</div>
EOT;

  return $output;
}
