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
$config['theme']['version'] = '20150617-1';


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
  'source' => 'theme_generated',
  'file'   => 'styles.css',
);

// Emergency vanilla .css file.
// $config['ui']['css_external'][] = array(
//   'source' => 'theme_static',
//   'file'   => 'static.css',
// );

// < style > tag in the < head >.
// $config['ui']['css_inline'][] = array(
//   'source' => 'theme_generated',
//   'file'   => 'extra_styles_inline.css',
// );


// #############################################################################
// JS.

// NOTE: each item's 'source' may be one of the following:
// - frontend_library,
// - frontend_assset,
// - theme.

// -----------------------------------------------------------------------------
// JS files for the HTML head.

// custom-feature-detects.js and modernizr.js should be concatenated together,
// so that this custom pack of feature detects are the only one js file that is
// loaded in the < head >.

$config['ui']['js_head_dependency'][] = array(
  'source'  => 'theme',
  'file'    => 'custom-feature-detects.js',
);

// http://modernizr.com/download/#-backgroundsize-flexbox-inlinesvg-svg-touch-cssclasses-teststyles-testprop-testallprops-domprefixes-cssclassprefix:mdz!
$config['ui']['js_head_dependency'][] = array(
  'source'  => 'theme',
  'file'    => 'modernizr.custom.80541.js',
);

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
// Further additions to the <head>.

$config['theme']['head_additions'] = array(
  '<meta name="viewport" content="width=device-width, initial-scale=1">',
  '<link href="http://fonts.googleapis.com/css?family=Roboto:400,300,700" rel="stylesheet" type="text/css">',
  // This is for a new meta tag that Android browsers support. They adjust the
  // color of the native interface to the site's primary color provided here.
  // '<meta name="theme-color" content="#000000">',
);
