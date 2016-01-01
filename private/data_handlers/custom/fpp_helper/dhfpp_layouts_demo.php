<?php
/**
 * @file
 * Offers overview of the states of .l--2sb component (= Layout--2-SideBars).
 *
 * .l--2sb is 'basic' theme's primary layout helper.
 */

/**
 * Standard function.
 *
 * Make its name match the file-name.
 */
function fpp_layouts_demo($args) {

  $output = <<<EOT
    <h2><code>.l--2sb</code> layout variants and states</h2>
    <div class="fpp-layouts-demo">
      <p>Note: these demos are intended to work when the <code>basic</code> theme is being set to active (see config).<p>
EOT;

  // ###########################################################################
  // Content-in-mid.

  // Only sidebar 1.
  $output .= <<<EOT
    <h3>Content in mid</h3>
    <h4>One sidebar</h4>

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
    <h4>Both sidebars</h4>

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
    <h3>Content on left</h3>
    <h4>One sidebar</h4>

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
    <h4>Both sidebars</h4>

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
    <h3>Content on right</h3>
    <h4>One sidebar</h4>

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
    <h4>Both sidebars</h4>

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

  $output .= '</div>';

  return $output;
}