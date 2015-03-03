<?php
/**
 * @file
 * Task helper for tasks that work with permanently stored data.
 */

// -----------------------------------------------------------------------------
// Init localization.
apputils_wake_resource('definitions', 'string_translations');

// -----------------------------------------------------------------------------
// Init data handling common utilities.
$content_utils_file =
  $registry['app_internals']['utilities'] . '/utility_data_common.php';
require_once($content_utils_file);

// -----------------------------------------------------------------------------
// Init data structure definitions.
apputils_wake_resource('definitions', 'structure');

// -----------------------------------------------------------------------------
// Init templating utilities.
$templating_utils_file =
  $registry['app_internals']['utilities'] . '/utility_templating.php';
require_once($templating_utils_file);

// -----------------------------------------------------------------------------
// Init actual templates. (If theme 'theme' is declared to be the source of
// templates but copying over the 'templates' directory was missed, then there
// will be problem.)
$template_functions =
  $registry['app_current']['templates'] . '/template_functions.php';
if (file_exists($template_functions)) {
  require_once($template_functions);
}
else {
  $header = $request['server_protocol'] . " 500 (php script failed)";
  sys_notify('File <em>template_functions.php</em> was not found.', 'warning');
  apputils_exit_nicely($header);
}

// -----------------------------------------------------------------------------
// Init template customizations.
$template_customizations =
  $registry['app_current']['templates'] . '/template_customizations.php';
include_once($template_customizations);

// -----------------------------------------------------------------------------
// Preparing system for the handled entity types.
foreach ($definitions['structure']['entity_definitions'] as $type_id => $data) {
  // Build and register a data types inventory.
  $registry['managed_entity_types'][] = $type_id;
  // Also, to prevent unexpected outcomes elsewhere, prepare empty containers
  // for them in the permanent_data_storage.
  $datapool['permanent_data_storage'][$type_id] = array();
}

// -----------------------------------------------------------------------------
// Update $registry with known present agents.
templateutils_import_pa_cache($registry);
