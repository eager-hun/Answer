<?php
/**
 * @file
 * App settings.
 *
 * @ingroup configuration.
 */

// #############################################################################
// Config Presets.

// NOTE 1: you can get multiple domain names (alternative HTTP_HOSTs) by setting
// up multiple virtual hosts to point to the directory of this installation.

// NOTE 2: you can get more info about the various dev- admin- and security
// modes towards the end of this very file, in the "CAUTION ZONE" section.

// Dev site presets.
$config['presets']['dev'] = [
  'http_protocol'    => 'http',
  'domain' => [
    'primary'   => 'your-dev-envs-HTTP_HOST-here',
    'secondary' => 'your-dev-envs-alternative-HTTP_HOST-here',
  ],
  'serve_bare_data'  => 1, // 0 || 1 .
  'dev_mode'         => 1, // 0 || 1 || 'verbose' .
  'admin_mode'       => 1, // 0 || 1 .
  'give_up_security' => 0, // 0 || 1 .
];

// Stage site presets.
$config['presets']['stage'] = [
  'http_protocol'    => 'http',
  'domain' => [
    'primary'   => 'stage.yourdomain.tld',
    'secondary' => 'stage-alt.yourdomain.tld',
  ],
  'serve_bare_data'  => 0,
  'dev_mode'         => 0,
  'admin_mode'       => 0,
  'give_up_security' => 0,
];

// Live site presets.
$config['presets']['live'] = [
  'http_protocol'    => 'http',
  'domain' => [
    'primary'   => 'yourdomain.tld',
    'secondary' => 'alt.yourdomain.tld',
  ],
  'serve_bare_data'  => 0,
  'dev_mode'         => 0,
  'admin_mode'       => 0,
  'give_up_security' => 0,
];

// Active preset: one of the ^^ above.
define('CONFIG_PRESET', 'dev');


// #############################################################################
// Environment config.

$config['env']['http_protocol'] =
  $config['presets'][CONFIG_PRESET]['http_protocol'];
$config['env']['domain']['locale']['primary'] =
  $config['presets'][CONFIG_PRESET]['domain']['primary'];
$config['env']['domain']['locale']['secondary'] =
  $config['presets'][CONFIG_PRESET]['domain']['secondary'];

// Working dir.
// Provide it, if your site is not operating from the document root (if the
// index.php is in a subdirectory).
// NOTE: don't use slashes at the beginning or at the end.
//
// If your index.php is in the document root however, provide FALSE as value,
// or an empty string.
$config['env']['working_dir'] = '';


// #############################################################################
// Document properties.

$config['document']['locale']['primary']['langcode']     = 'en';
$config['document']['locale']['primary']['php_locale']   = 'en-GB.utf8';
$config['document']['locale']['secondary']['langcode']   = 'hu';
$config['document']['locale']['secondary']['php_locale'] = 'hu-HU.utf8';

// Most recent modification to this website (or its contents). (The intention is
// giving the visitor a hint on the 'abandonedness' of the website. IMO,
// abandoned websites with outdated content can cause real inconvenience for
// people in a number of situations.)
$config['document']['global_lastmod'] = '2015-04-10'; // (format: YYYY-MM-DD)


// #############################################################################
// Dependencies.

// -----------------------------------------------------------------------------
// Dependencies: external php libraries.

// If you have installed the dependency:
//   provide the path to and the name of the initializer file.
//   (Note: a bit more below you will find prepared values for these libraries'
//   default location.)
// If you haven't installed the dependency:
//   set the value to FALSE.
// NOTE: a Composer manifest is already prepared for downloading these
// dependencies. For more info see:
//   /private/libraries_backend/README and
//   /composer.json

$config['app']['dependencies']['htmlpurifier'] = FALSE;
$config['app']['dependencies']['php-markdown'] = FALSE;

/*
// The following are prepared in accordance with the location Composer was
// configured (in /composer.json) to place libraries.
$config['app']['dependencies']['htmlpurifier'] =
  $registry['app_internals']['libraries_backend']
  . '/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
$config['app']['dependencies']['php-markdown'] =
  $registry['app_internals']['libraries_backend']
  . '/michelf/php-markdown/Michelf/Markdown.inc.php';
*/

// $config['app']['suppress_warnings'][] = 'dependency_htmlpurifier';
// $config['app']['suppress_warnings'][] = 'dependency_php-markdown';


// #############################################################################
// Further app config.

// Reserved/watched paths.

// Admin path: choose a path for your admin interface.
// (Do not imitate subdirectories, IOW don't use slashes!)
$config['app']['admin_path'] = 'for-example-this';

// The array value is the watched path fragment, and the array key will become
// the task id for the request.
$config['app']['reserved_paths'] = array(
  'bare_data'     => 'bare-data',
  'admin'         => $config['app']['admin_path'],
  // Unfinished features:
  // 'session'       => 'session',
  // 'ajax'          => 'ajax',
);

// NOTE: the fast 404 feature has fallen a bit behind on the priority list,
// therefore it is being a bit untested (a.k.a. TODO).
$config['app']['fast_404'] = FALSE;


// #############################################################################
// User interface.

// -----------------------------------------------------------------------------
// Theme-agnostic javascripts that the system counts/relies on.

$config['ui']['js_settings_insertion'] = 'body'; // head || body.

// JS files for the bottom of the <body>.
$config['ui']['js_body'][] = array(
  //'source'     => 'frontend_library',
  //'file'       => 'jquery/dist/jquery.min.js',
  'source'     => 'cdn',
  'file'       => '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',
  'attributes' => array(),
);
$config['ui']['js_body'][] = array(
  'source'     => 'frontend_asset',
  'file'       => 'system.js',
  'attributes' => array(),
);


// #############################################################################
// Theme config.

// Important note: after changing these theme settings, it is neccessary to
// rebuild theme registry, via the 'admin interface'.

// The theme name is the name of its directory.
$config['theme']['name'] = 'basic';

// Practical tip: ALWAYS copy the whole templating directory into your theme and
// do customizations / additions to the instance in your theme. If you have done
// that, then set the following value to 'theme'.
$config['theme']['templates_source'] = 'system'; // system || theme.


// #############################################################################
// Short-tags config.

// @see:
// http://vbence.web.elte.hu/regex_leiras.html
// http://regexper.com/

/**
 * Documentation:
 * 1. Don't use this short tags system.
 *    This is not a good implementation of the concept.
 * 2. Also see declaration of _translate_short_tags().
 * 3. Yet, don't use short tags.
 * 4. I might risk doing it, but you shouldn't :)
 */

$config['content']['short_tags'] = array(
  'patterns' => array(
    1  => '#<!--HERO-->#',
    2  => '#<!--/HERO-->#',
    3  => '#<!--NOTE-->#',
    4  => '#<!--/NOTE-->#',
    5  => '#<!--HIGH-->#',
    6  => '#<!--/HIGH-->#',
    7  => '#<!--LINKS-->#',
    8  => '#<!--/LINKS-->#',
    9  => '#<!--DEFS-->#',
    10 => '#<!--/DEFS-->#',
    11 => '#<!--ITEM-->#',
    12 => '#<!--/ITEM-->#',
    13 => '#<!--SPLITTER-->#',
    14 => '#<!--/SPLITTER-->#',
    15 => '#<!--(CONTENT) ID=([0-9]+)-->#',
  ),
  'replacements' => array(
    1  => '<div class="textbox textbox--hero">',
    2  => '</div>',
    3  => '<div class="textbox textbox--note">',
    4  => '</div>',
    5  => '<div class="textbox textbox--hilite">',
    6  => '</div>',
    7  => '<div class="textbox textbox--links">',
    8  => '</div>',
    9  => '<div class="defs">',
    10 => '</div>',
    11 => '<div class="item">',
    12 => '</div>',
    13 => '<div class="splitter__fit"><div class="splitter__wrap"><div class="splitter">',
    14 => '</div></div></div>',
    15 => 'dynamic replacement from function',
  ),
);


// #############################################################################
// MISC.

$config['xml_sitemap_generator']['domain']['primary'] =
  $config['presets']['live']['domain']['primary'];
$config['xml_sitemap_generator']['domain']['secondary'] =
  $config['presets']['live']['domain']['secondary'];

// Custom substring used for prefixing the XML sitemap filename.
$config['xml_sitemap_generator']['sitemap_name'] = 'sitemap';

// Custom substring for prefixing HTML id attributes that go through
// htmlpurifier.
// (See "Namespacing IDs" at http://htmlpurifier.org/docs/enduser-id.html .)
$config['htmlpurifier']['id_prefix'] = 'anchor--';


// #############################################################################
// CAUTION ZONE.

// The bare-data mode currently returns content without authenticating requests.
// This - at least theoretically - opens up the possibility for other websites
// to "borrow" your content.
$config['app']['serve_bare_data'] =
  $config['presets'][CONFIG_PRESET]['serve_bare_data'];

// The dev_mode may do things that are risky to do on a public server!
// NEVER enable dev_mode on public instances!
$config['app']['dev_mode'] =
  $config['presets'][CONFIG_PRESET]['dev_mode'];

// WARNING: __DO NOT__ set admin_mode to TRUE if this installation is located on
//          any other server than your isolated home developer machine.
//
//          Why? Because this application does not have any ways of checking
//          authorization on the web-requests it receives. Anyone who sees this
//          website can trigger any action on it. (however
//          $_SERVER['REMOTE_ADDR'] might appear as a suitable emergency asset
//          candidate, its usage is strongly discouraged.) Even if it is an
//          admin action. Therefore admin functionality should be disabled on
//          installations that are publicly accessible.
//
//          See notes below.
//
// 1. At the current level of development (less than basic) the gist is that
//    ALL changes to content and content-related caches should be done on an
//    isolated development instance, and, if things are needed on a public
//    server, then the updated files could be deployed to live, either through
//    git or rsync or FTP or by a CD sent over a parcel delivery service.
//
// 2. FURTHER NOTE: if the isolated developer instance is indeed set up and also
//    the chosen deploy path proves to be a viable way of updating content, then
//    - as a security precaution - the admin data-handler 'dh_admin' could be
//    entirely deleted from the public instance; thus ensuring the
//    impossibility of unwanted access to admin functions.
$config['app']['admin_mode'] =
  $config['presets'][CONFIG_PRESET]['admin_mode'];

// The give_up_security switch allows unsafe setting combinations to be used.
// NEVER enable give_up_security on public instances!
$config['app']['give_up_security'] =
  $config['presets'][CONFIG_PRESET]['give_up_security'];
