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
);

$config['ui']['css_external'][] = array(
  'source' => 'theme_static',
  'file'   => 'static.css',
);


// #############################################################################
// JS.

// NOTE: each item's 'source' may be one of the following:
// - frontend_library,
// - frontend_assset,
// - theme.

// -----------------------------------------------------------------------------
// JS files for the HTML head.

// http://modernizr.com/download/#-inlinesvg-svg-touch-shiv-cssclasses-teststyles-prefixes-cssclassprefix:mdz!
// $config['ui']['js_body_dependency'][] = array(
//   'source'  => 'frontend_asset',
//   'file'    => 'modernizr.custom.25804.js',
// );

// -----------------------------------------------------------------------------
// JS files for the HTML body.

$config['ui']['js_body'][] = array(
  'source'  => 'theme',
  'file'    => 'theme.js',
  'attribs' => array('async'),
);

// $config['ui']['js_body'][] = array(
//   'source'  => 'frontend_asset',
//   'file'    => 'visual-debug.js',
//   'attribs' => array('async'),
// );


// #############################################################################
// Further additions to the < head >.

$config['theme']['head_additions'] = array(
  '<meta name="viewport" content="width=device-width, initial-scale=1">',
);
