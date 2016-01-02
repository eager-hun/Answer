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
$config['theme']['version'] = '20150102-1';


// #############################################################################
// Additions by the theme to the <head>.

$config['theme']['head_additions'] = array(
  '<meta name="viewport" content="width=device-width, initial-scale=1">',
  // https://validator.w3.org/mobile-alpha/ said that a placeholder favicon
  // declaration can be done as follows:
  '<link rel="icon" href="data:;base64,iVBORw0KGgo=">',
  // I still have to learn loading Google fonts in a non-render-blocking way.
  // '<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,700" rel="stylesheet" type="text/css">',
);


// #############################################################################
// CSS.

// NOTE: each item's 'source' may be one of the following:
// - frontend_library,
// - frontend_assset,
// - theme_generated,
// - theme_static.

// -----------------------------------------------------------------------------
// Inlined CSS.

// Optional: styles inlined into a < style > tag in the < head >.
$config['ui']['css_inline'][] = array(
  'source'     => 'theme_generated',
  'file'       => 'extra_styles_inline.css',
  'is_enabled' => 0,
);
// We could inline the contents of static .css files too.
$config['ui']['css_inline'][] = array(
  'source'     => 'theme_static',
  'file'       => 'static.css',
  'is_enabled' => 0,
);

// -----------------------------------------------------------------------------
// Linked CSS.

// Normalize.css has a prepared setup in styles.scss to include it into
// styles.css with SASS/Compass.
$config['ui']['css_external'][] = array(
  'source'     => 'frontend_library',
  'file'       => 'normalize.css/normalize.css',
  'is_enabled' => 1,
);

// The custom theme's styles.
$config['ui']['css_external'][] = array(
  'source'     => 'theme_generated',
  'file'       => 'styles.css',
  'is_enabled' => 1,
);

// Skin styles.
$config['ui']['css_external'][] = array(
  'source'     => 'theme_generated',
  'file'       => 'skin.css',
  'is_enabled' => 1,
);

// Optional: vanilla .css file.
$config['ui']['css_external'][] = array(
  'source'     => 'theme_static',
  'file'       => 'static.css',
  'is_enabled' => 0,
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
  'is_enabled' => 1,
);
