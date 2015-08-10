<?php
/**
 * @file
 * director.php
 *
 * director.php is like a backbone to the app: through the procedural approach,
 * this is where the assets are being included as the script progresses.
 *
 * Progress-dependent declaration of variables and settings also take place in
 * here.
 */

define('DIRECTOR_DIR', dirname(__FILE__) . '/');

$config = array();

// Registry is being used to describe internal properties of the app.
// Here in director.php, on a number of occassions we append directory names and
// path fragments to it that allocate the app's resources in the file system.
$registry = array();

// App internals are being used when including files in the php script.
$registry['app_internals'] = array();

// The installation is capable of holding config, definitions, and content for a
// number of different website instances (though it is not a true multisite in
// that aspect). 'App current' is being used to locate website-instance-specific
// resources.
$registry['app_current'] = array();

// App externals will hold paths to resources for external clients (browsers);
// so they end up being used for constructing web URLs.
$registry['app_externals'] = array();

// -----------------------------------------------------------------------------
// @ingroup configuration

// NOTE: When entering path fragment strings into $registry items, make it so
// that there are NO slashes at the beginning and at the end of the _resulting_
// strings.

// NOTE ON THE DIRECTORY STRUCTURE: it was intended make it possible to move
// director.php and the 'private' directory out of and above the public root.
$registry['app_internals']['private_assets'] = DIRECTOR_DIR . 'private';

// Public assets are needed to be accessed for inclusion by the script in
// theme-related contexts: reading the theme_settings.php, and it is also
// recommended that 'present agents' and templating functions are being stored
// and managed in the theme; they then will have to be included from there.
$registry['app_internals']['public_assets'] = DIRECTOR_DIR . 'public';

// This will be the part of all externally accessed urls to resources.
// Provide the name of the directory that contains your public assets (this
// string will be added to the base_path() output).
$registry['app_externals']['path_root'] = 'public';

// The website instance to be used.
// This should be the name of the directory that will represent the site
// instance in e.g. the config, definitions and permanent_strorage directories.
$registry['app_internals']['website_instance'] = 'example_website';

// Most recent modification to this website (or its contents).
// The intention is giving the visitor a hint on the 'abandonedness' of the
// website. IMO, abandoned websites with outdated content can cause real
// inconvenience for people in a number of situations.
// Format: YYYY-MM-DD .
$config['site_global_lastmod'] = '2015-08-10';

// Configuration ends.
// -----------------------------------------------------------------------------

$registry['app_internals']['app'] =
  $registry['app_internals']['private_assets'] . '/app';

$registry['app_internals']['utilities'] =
  $registry['app_internals']['app'] . '/utilities';

$registry['app_internals']['config'] =
  $registry['app_internals']['private_assets'] . '/config';

$registry['app_internals']['definitions'] =
  $registry['app_internals']['private_assets'] . '/definitions';

$registry['app_internals']['data_handlers'] =
  $registry['app_internals']['private_assets'] . '/data_handlers';

$registry['app_internals']['storage'] =
  $registry['app_internals']['private_assets'] . '/permanent_storage';

$registry['app_internals']['libraries_backend'] =
  $registry['app_internals']['private_assets'] . '/libraries_backend';

$registry['app_internals']['cache'] =
  $registry['app_internals']['private_assets'] . '/cache';

$registry['app_current']['config'] =
  $registry['app_internals']['config']
  . '/' . $registry['app_internals']['website_instance'];


// #############################################################################
// Initiate global variables.
// (And ones that are likely to receive appended data straight away.)

$config['presets']                                     = array();
$config['presets']['dev']                              = array();
$config['presets']['stage']                            = array();
$config['presets']['live']                             = array();
$config['env']                                         = array();
$config['env']['live_site_domain']                     = array();
$config['app']                                         = array();
$config['app']['suppress_warnings']                    = array();
$config['theme']                                       = array();
$config['ui']                                          = array();
$config['ui']['css_inline']                            = array();
$config['ui']['css_external']                          = array();
$config['ui']['js_head_early']                         = array();
$config['ui']['js_head_regular']                       = array();
$config['ui']['js_head_late']                          = array();
$config['ui']['js_body_early']                         = array();
$config['ui']['js_body_regular']                       = array();
$config['ui']['js_body_late']                          = array();
$config['content']                                     = array();
$config['content']['short_tags']                       = array();
$config['xml_sitemap_generator']                       = array();
$config['xml_sitemap_generator']['domain']             = array();
$request                                               = array();
$request['sections']                                   = array();
$request['contexts']                                   = array();
$registry['managed_entity_types']                      = array();
$definitions                                           = array();
$datapool                                              = array();
$datapool['permanent_data_storage']                    = array();
$datapool['paths']                                     = array();
$sys_notifications_pool                                = array();
$temp                                                  = array();
$temp['initiated_resources']                           = array();
$temp['initiated_resources']['classes']                = array();
$temp['initiated_resources']['definitions']            = array();
$temp['initiated_resources']['data_handler']           = array();
$temp['initiated_resources']['permanent_data_storage'] = array();
$temp['initiated_resources']['presentation_agent']     = array();
$temp['initiated_resources']['layout']                 = array();
$temp['data_statuses']                                 = array();
$temp['raw_paths']                                     = array();
$temp['dependencies']                                  = array();
$temp['dependencies']['met']                           = array();
$temp['raw_entities']                                  = array();
$temp['entity_metadata']                               = array();
$temp['rendered_menus']                                = array();
$temp['raw_attributes']                                = array();
$temp['raw_attributes']['html']                        = array();
$temp['raw_attributes']['html']['class']               = array();
$temp['raw_attributes']['head']                        = array();
$temp['raw_attributes']['head']['class']               = array();
$temp['raw_attributes']['body']                        = array();
$temp['raw_attributes']['body']['class']               = array();
$temp['layout_elements']                               = array();
$temp['layout_elements']['body_start']                 = array();
$temp['layout_elements']['body_end']                   = array();


// #############################################################################
// App progress: initial declarations + reading config.

require_once($registry['app_internals']['utilities'] . '/utility_security.php');
require_once($registry['app_internals']['utilities'] . '/utility_app_init.php');
require_once($registry['app_current']['config'] . '/config.php');

// Introducing config preset values to the application.
$config['env']['http_protocol'] =
  $config['presets'][CONFIG_PRESET]['http_protocol'];
$config['env']['domain']['locale']['primary'] =
  $config['presets'][CONFIG_PRESET]['domain']['primary'];
$config['env']['domain']['locale']['secondary'] =
  $config['presets'][CONFIG_PRESET]['domain']['secondary'];
$config['env']['working_dir'] =
  $config['presets'][CONFIG_PRESET]['working_dir'];
$config['app']['serve_bare_data'] =
  $config['presets'][CONFIG_PRESET]['serve_bare_data'];
$config['app']['dev_mode'] =
  $config['presets'][CONFIG_PRESET]['dev_mode'];
$config['app']['admin_mode'] =
  $config['presets'][CONFIG_PRESET]['admin_mode'];
$config['app']['give_up_security'] =
  $config['presets'][CONFIG_PRESET]['give_up_security'];

// Site-instance-dependent locations.
$registry['app_current']['definitions'] =
  $registry['app_internals']['definitions']
    . '/' . $registry['app_internals']['website_instance'];

$registry['app_current']['storage'] =
  $registry['app_internals']['storage']
    . '/' . $registry['app_internals']['website_instance'];

$registry['app_current']['cache'] =
  $registry['app_internals']['cache']
    . '/' . $registry['app_internals']['website_instance'];

// -----------------------------------------------------------------------------
// Post-config adjustments.

implement_security_policies();

// Optionally disabling htmlpurifier.
// NOTE: activating 'give_up_security' in config presets makes this complete.
// WARNING: UNSAFE ACTION, only for isolated development environments!
// apputils_disable_htmlpurifier();


// #############################################################################
// App progress: stages.

// -----------------------------------------------------------------------------
// Orientation stage.
require_once($registry['app_internals']['app'] . '/orientation/orientation.php');

// -----------------------------------------------------------------------------
// Task handler stage.
// Registering theme and templating setup.
$registry['app_internals']['theme'] =
  $registry['app_internals']['public_assets']
  . '/themes/' . ensafe_string($config['theme']['name'], 'path_fragment');

// Templates' and present agents' source.
if ($config['theme']['templates_source'] == 'theme') {
  $registry['app_current']['templates'] =
    $registry['app_internals']['theme'] . '/templates';
}
// Else use the system's default within the private directory.
else {
  $registry['app_current']['templates'] =
    $registry['app_internals']['private_assets'] . '/templates';
}

// Present agents could live in a subdirectory of templates.
$registry['app_current']['presentation_agents'] =
  $registry['app_current']['templates'] . '/presentation_agents';

// Registering locations of resources that are available externally, via web
// URLs.
$registry['app_externals']['path_root'] =
  base_path() . $registry['app_externals']['path_root'];

$registry['app_externals']['theme'] = $registry['app_externals']['path_root']
  . '/themes/' . ensafe_string($config['theme']['name'], 'path_fragment');

$registry['app_externals']['libraries_frontend'] =
  $registry['app_externals']['path_root'] . '/libraries_frontend';

$registry['app_externals']['assets_frontend'] =
  $registry['app_externals']['path_root'] . '/shared_assets';

$registry['app_externals']['document_files'] =
  $registry['app_externals']['path_root'] . '/document_files';

// Handling the current task.
$non_content_tasks = array(
  'session'
);
if (!in_array($request['task']['type'], $non_content_tasks)) {
  require_once($registry['app_internals']['app'] . '/task_handlers/task_helper_data_common.php');
}
if ($request['task']['type'] == 'admin') {
  $request['task']['type'] = 'page';
  $request['page_id']      = 'admin-interface';
}
$task_handler_file = 'task_handler_' . $request['task']['type'] . '.php';
require_once($registry['app_internals']['app'] . '/task_handlers/' . $task_handler_file);


// #############################################################################
// System diagnostics.

if (is_dev_mode()) {
  $included_files = get_included_files();

  // show('included_files');
  // show('registry');
  // show('config');
  // show('request');
  // show('definitions');
  // show('temp');
  // show('datapool');
  // show('page');
  // show('document');

  // This one is neccessary for the above show()s to show.
  print process_sys_notifications($sys_notifications_pool);

  // print apputils_script_diagnostics();
}

exit;
