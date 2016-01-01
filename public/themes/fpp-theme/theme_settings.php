<?php
/**
 * @file
 * Theme settings.
 *
 * For more info on the available matrix of settings you can consult the
 * declaration of pageutils_document_assets() and _include_script() in
 * /private/app/utilities/utility_page.php.
 */

// This will be appended as a query argument in the links for .css and .js
// assets.
$config['theme']['version'] = '20150608-1';


// #############################################################################
// STYLESHEETS.

// NOTE: each item's 'source' may be one of the following:
// - frontend_library,
// - frontend_assset,
// - theme_generated,
// - theme_static.

$config['ui']['css_external'][] = array(
  'source' => 'frontend_library',
  'file'   => 'normalize.css/normalize.css',
  'is_enabled' => 1,
);

$config['ui']['css_external'][] = array(
  'source' => 'theme_static',
  'file'   => 'static.css',
  'is_enabled' => 1,
);


// #############################################################################
// JS.

// NOTE: each item's 'source' may be one of the following:
// - inline,
// - cdn,
// - frontend_library,
// - frontend_assset,
// - theme.

// -----------------------------------------------------------------------------
// JS files for the HTML head.

// Mandatory script for elementary UI behaviors.
$config['ui']['js_head_early'][] = array(
  'source'     => 'theme',
  'file'       => 'custom-feature-detects.js',
  'is_enabled' => 1,
);

// -----------------------------------------------------------------------------
// JS files for the HTML body.

// Custom theme behaviors.
$config['ui']['js_body_regular'][] = array(
  'source'     => 'theme',
  'file'       => 'theme.js',
  'async'      => 1,
  'is_enabled' => 1,
);

// Optional: visualises page structure.
$config['ui']['js_body_regular'][] = array(
  'source'     => 'frontend_asset',
  'file'       => 'visual-debug.js',
  'async'      => 1,
  'is_enabled' => 0,
);

// A note about modernizr being loaded with async: I recently started having
// this bug: https://code.google.com/p/chromium/issues/detail?id=263304
// Asyncing modernizr seems to solve it. This is very far from being very good,
// but those flickers on Chrome were a total disaster.

// Have it generated, then download the customized Modernizr build from here:
// http://modernizr.com/download/#-backgroundsize-flexbox-inlinesvg-svg-touch-cssclasses-teststyles-testprop-testallprops-domprefixes-cssclassprefix:mdz!
$config['ui']['js_body_late'][] = array(
  'source'     => 'theme',
  'file'       => 'modernizr.custom.80541.js',
  'async'      => 1,
  'is_enabled' => 0,
);
