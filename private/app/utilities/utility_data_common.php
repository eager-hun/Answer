<?php
/**
 * @file
 * Utility functions for handling permanently stored data.
 */

/**
 * Data fetching wrapper function.
 */
function datautils_data_fetcher($args, $fetch_options = array()) {
  if ($args['data_type'] == 'entity') {
    _fetch_entity_raw($args, $fetch_options);
  }
  elseif ($args['data_type'] == 'binder') {
    _fetch_binder($args, $fetch_options);
  }
  elseif ($args['data_type'] == 'current_page_primary_content') {
    // The primary content had been fetched earlier by the task handler itself
    // because that data may be needed earlier.
    return;
  }
  else {
    $message = 'Error: unrecognized data type was requested from data fetcher.';
    sys_notify($message, 'alert');
    return FALSE;
  }
}

/**
 * Fetch a single entity.
 */
function _fetch_entity_raw($args, $fetch_options) {

  // ###########################################################################
  // Evaluating request.

  if (empty($args['entity_type'])) {
    $message = 'Entity type was unprovided while requesting entity.';
    sys_notify($message);
    $GLOBALS['temp']['data_statuses'][$args['instance_id']] = '400';
    return FALSE;
  }

  $entity_type = $args['entity_type'];
  $instance_id = $args['instance_id'];

  // Checking if the requested entity type exists.
  if (!in_array($entity_type, $GLOBALS['registry']['managed_entity_types'])) {
    if (is_dev_mode()) {
      $message = 'The requested entity type <em>'
        . ensafe_string($entity_type, 'attribute_value')
        . '</em> is not detectable in the system.';
    }
    else {
      $message = 'The requested entity type is not detectable in the system.'
        . ' Dev mode may have more.';
    }
    sys_notify($message, 'warning');
    $GLOBALS['temp']['data_statuses'][$instance_id] = '404';
    return FALSE;
  }
  // Loading the entity type records.
  apputils_wake_resource('permanent_data_storage', $entity_type);
  // Checking if data id exists in storage.
  if (!array_key_exists($instance_id, $GLOBALS['datapool']['permanent_data_storage'][$entity_type])) {
    if (is_dev_mode()) {
      $message = 'Requested instance_id <em>'
        . ensafe_string($instance_id, 'attribute_value')
        . '</em> cannot be found on storage in requested entity type <em>'
        . ensafe_string($entity_type, 'attribute_value') . '</em>.';
    }
    else {
      $message = 'Requested instance_id is not found. Dev mode may have more.';
    }
    sys_notify($message, 'warning');
    $GLOBALS['temp']['data_statuses'][$instance_id] = '404';
    return FALSE;
  }


  // ###########################################################################
  // Looking into the data.

  // Get a convenient copy to work with.
  $record = $GLOBALS['datapool']['permanent_data_storage'][$entity_type][$instance_id];

  if (!empty($fetch_options['entity_only_meta'])) {
    $GLOBALS['temp']['entity_metadata'][$instance_id] = array(
      'meta'   => $record['meta'],
    );
    return;
  }

  // Not working twice or more.
  if (!empty($GLOBALS['temp']['raw_entities'][$instance_id])) {
    // We already have a fetched instance of this entity.
    return;
  }

  // Is the entity published?
  if (empty($record['meta']['is_published'])) {
    if (!is_admin()) {
      $GLOBALS['temp']['data_statuses'][$instance_id] = '403';
      return FALSE;
    }
    elseif (is_dev_mode('verbose')) {
      $message = 'Unpublished entity on display: <code>'
        . ensafe_string($instance_id, 'attribute_value') . '</code>.';
      sys_notify($message);
    }
  }

  // Narrowing the list of the to-be-processed fields to those that were
  // requested.
  if (!empty($args['fetch_fields'])) {
    $record['data'] = array_intersect_key($record['data'], array_flip($args['fetch_fields']));
  }
  // Else all fields will be processed.


  // ###########################################################################
  // Talking to the field handler starts.

  $fields = array();
  $field_defs = $GLOBALS['definitions']['structure']['entity_definitions'][$entity_type]['fields'];

  foreach($record['data'] as $field_id => $field_data) {
    // Preparing common args for the field handlers.
    $args['field_id']   = $field_id;
    $args['field_defs'] =
      $GLOBALS['definitions']['structure']['entity_definitions'][$entity_type]['fields'][$field_id];
    $args['field_data'] = $field_data;
    $args['record']     = $record;

    if (!empty($field_defs[$field_id]['type'])) {
      $field_type = $field_defs[$field_id]['type'];
      apputils_wake_resource('data_handler', $field_type);

      // Get field data.
      $dh_function = 'dh_' . $field_type;
      if (function_exists($dh_function)) {
        $fields[$field_id] = $dh_function($args);
      }
    }
    elseif (is_dev_mode()) {
      sys_notify('Missing field definition.', 'warning');
    }
  }
  unset($field_id, $field_data);

  $GLOBALS['temp']['raw_entities'][$instance_id] = array(
    'meta'   => $record['meta'],
    'fields' => $fields,
  );
  $GLOBALS['temp']['data_statuses'][$instance_id] = '200';
}

/**
 * Fetch a binder.
 *
 * This is a tricky thing. Raw-fetching a binder only triggers its bound
 * entities being pre-fetched and stored in $temp array in a raw state.
 * The function will look up every nested level of binders and makes sure that
 * the deepest level of entities are found and being pre-fetched.
 *
 * Rendering of bound items, and complete-rendering binders should happen at
 * a later point, by calling data_dresser.
 */
function _fetch_binder($args, $fetch_options) {
  $output = '';
  // If we have the definitions for it.
  if (!empty($GLOBALS['definitions']['binders'][$args['instance_id']])) {
    $binder_definition = $GLOBALS['definitions']['binders'][$args['instance_id']];
    foreach ($binder_definition['items'] as $item) {
      if (should_content_show($item)) {
        datautils_data_fetcher($item, $fetch_options);
      }
    }
    unset($item);

    $GLOBALS['temp']['data_statuses'][$args['instance_id']] = '200';
  }
  // Else no defs found.
  else {
    if (is_dev_mode()) {
      $message = 'Data fetcher could not find the definitions for the requested binder: <em>'
        . ensafe_string($args['instance_id'], 'attribute_value') . '</em>.';
    }
    else {
      $message = 'Data fetcher could not find the definitions for the requested binder.';
    }
    sys_notify($message, 'alert');
    $GLOBALS['temp']['data_statuses'][$args['instance_id']] = '404';
  }
  return $output;
}

/**
 * Content visibility decision helper.
 *
 * This, though works, obviously looks not smart.
 */
function should_content_show($args) {
  // If we don't have a page_id, it's likely data is being accessed in a
  // non-page situation (e.g.: bare-data reqest), so allow everything to show.
  if (empty($GLOBALS['request']['page_id'])) {
    return TRUE;
  }
  if (!empty($args['presence'])) {
    if (!empty($args['presence']['global'])) {
      return TRUE;
    }
    // Based on PAGE_ID.
    elseif (!empty($args['presence']['variable'])
            && $args['presence']['variable'] == 'page_id') {
      if ($args['presence']['condition'] == 'is') {
        if ($GLOBALS['request']['page_id'] == $args['presence']['value']) {
          return TRUE;
        }
        else {
          return FALSE;
        }
      }
      elseif ($args['presence']['condition'] == 'is_not') {
        if ($GLOBALS['request']['page_id'] == $args['presence']['value']) {
          return FALSE;
        }
        else {
          return TRUE;
        }
      }
    }
    // Based on CONTEXT.
    elseif (!empty($args['presence']['variable'])
            && $args['presence']['variable'] == 'context') {

      if ($args['presence']['condition'] == 'is') {
        if (in_array($args['presence']['value'], $GLOBALS['request']['contexts'])) {
          return TRUE;
        }
        else {
          return FALSE;
        }
      }
      elseif ($args['presence']['condition'] == 'is_not') {
        if (in_array($args['presence']['value'], $GLOBALS['request']['contexts'])) {
          return FALSE;
        }
        else {
          return TRUE;
        }
      }
    }
    // Based on SECTION.
    elseif (!empty($args['presence']['variable'])
            && $args['presence']['variable'] == 'section') {
      if ($args['presence']['condition'] == 'is') {
        if (in_array($args['presence']['value'], $GLOBALS['request']['sections'])) {
          return TRUE;
        }
        else {
          return FALSE;
        }
      }
      elseif ($args['presence']['condition'] == 'is_not') {
        if (in_array($args['presence']['value'], $GLOBALS['request']['sections'])) {
          return FALSE;
        }
        else {
          return TRUE;
        }
      }
    }
    else {
      return FALSE;
    }
  }
  // Default is TRUE.
  else {
    return TRUE;
  }
}

/**
 * Filter for different text formats.
 */
function datautils_filter($params) {
  global $temp;

  if ($params['text_format'] == 'md') {
    apputils_wake_resource('class', 'php-markdown');

    if (in_array('php-markdown', $temp['dependencies']['met'])) {
      $parsed = \Michelf\Markdown::defaultTransform($params['data']);
    }
    else {
      // Supposedly the resource loader already sys_notified about it, so
      // here we can just fall back to printing the input as is.
      $parsed = $params['data'];
    }
    _translate_short_tags($parsed);
    $output = ensafe_string($parsed, 'html');
  }
  elseif ($params['text_format'] == 'html') {
    $output = ensafe_string($params['data'], 'html');
  }
  elseif ($params['text_format'] == 'txt') {
    $output = ensafe_string($params['data']);
  }
  else {
    if (is_dev_mode()) {
      $message = 'Either unrecognized text format <em>' . $params['text_format']
        . '</em> was provided for the text filter, or there was no text format provided.';
    }
    else {
      $message = 'Either unrecognized text format was povided for the text filter, or there was no text format provided.';
    }
    sys_notify($message, 'warning');
    $output = FALSE;
  }
  return $output;
}

/**
 * Replace patterns in content was filtered previously by Markdown.
 */
function _translate_short_tags(&$input) {
  $patterns = $GLOBALS['config']['content']['short_tags']['patterns'];
  $input = preg_replace_callback(
    $patterns,
    "_short_tags_replacements",
    $input
  );
}

/**
 * Definitions of what to do with short-tags.
 */
function _short_tags_replacements($matches) {
  $patterns     = $GLOBALS['config']['content']['short_tags']['patterns'];
  $replacements = $GLOBALS['config']['content']['short_tags']['replacements'];
  $string = $matches[0];

  // The regex definition did not define groups (and therefore variables).
  // This is the most simple case, and the most easy to deal with.
  if (count($matches) == 1) {
    $output = $replacements[array_search('#' . $string . '#', $patterns)];
  }
  // Else additional variables were passed into the $matches array.
  else {
    // The first set of parentheses should enclose the short-tag's name, so that
    // here we can more easily examine which tag we are dealing with.

    // GRID type short-tag.
    if ($matches[1] == 'GRID') {
      // The 'GRID' short-tag's definition should look like this:
      // <!--GRID COLS=2-->
      if (!empty($matches[2])) {
        $output = '<div class="grid" data-cols="'
          . filter_var($matches[2], FILTER_SANITIZE_NUMBER_INT) . '">';
      }
      else {
        // Not much point in it, just a safety fallback.
        $output = '<div class="grid">';
      }
    }
    // CONTENT type short-tag.
    elseif ($matches[1] == 'CONTENT') {
      // The 'CONTENT' short-tag's definition should look like this:
      // <!--CONTENT ID=13-->
      // Note that it is an unpaired tag (no closing tag is needed).

      // Definition for a test item.
      if ($matches[2] == '13') {
        sys_notify("There is a definition placeholder for the used CONTENT type short-tag, but it doesn't do much.");
        $output = '';
      }
      // No definition.
      else {
        sys_notify('No definition was found for the used CONTENT type short-tag.', 'warning');
        $output = '';
      }
    }
    else {
      // This move is somewhat questionable.
      $output = '<div>';
    }
  }
  return $output;
}

/**
 * Providing localized strings.
 */
function loc($desired_key, $for_locale = '') {
  global $definitions;

  if (empty($for_locale)) {
    if (!empty($definitions['string_translations'][LOCALE_KEY][$desired_key])) {
      return ensafe_string($definitions['string_translations'][LOCALE_KEY][$desired_key], 'html');
    }
    elseif (is_dev_mode()) {
      return '<em><strong>MISSING L10N:</strong> ' . ensafe_string($desired_key, 'html') . '</em>';
    }
    else {
      return ensafe_string($desired_key);
    }
  }
  else {
    if (!empty($definitions['string_translations'][$for_locale][$desired_key])) {
      return ensafe_string($definitions['string_translations'][$for_locale][$desired_key], 'html');
    }
    elseif (is_dev_mode()) {
      return '<em><strong>MISSING L10N:</strong> ' . ensafe_string($desired_key, 'html') . '</em>';
    }
    else {
      return ensafe_string($desired_key, 'html');
    }
  }
}

/**
 * Send the regular batch of HTTP response headers.
 */
function datautils_send_standard_headers($request) {
  $charset_header = 'Content-Type: text/html; charset=utf-8';
  header($charset_header);
  header("X-Content-Type-Options: nosniff");
  header_remove("Server"); // But it was not set by php, so...
  header_remove("X-Powered-By");
}


// #############################################################################
// Menus-related functions.

/**
 * Pre-render menus.
 *
 * The following menu-handling system was again brought over from legacy code.
 * (O.k., to be fair, two months ago this was the bees' knees.)
 */
function datautils_prepare_menus($config, $request, $definitions, &$temp) {

  // Building a database of the menu parents and children.
  // 1. Identifying all parent items in all menus.
  // 2. Identifying all children items in all menus.
  // 3. Enumerating children items as menu-subsets grouped under their parents,
  //    in the $temp array.
  _prepare_menu_data($definitions, $request, $temp);

  if (!empty($definitions['menus'])) {
    // Packaging all menu levels into the same block, nested.
    foreach ($definitions['menus'] as $menu_id => $menu_data) {
      // Rendering and stashing the menu into the $temp array.
      $temp['rendered_menus'][$menu_id] = _render_menu_level($menu_id, 1, $menu_data);
    }
  }
}

function _prepare_menu_data($definitions, $request, &$temp) {
  $temp['menu_trails']       = array();
  $temp['menu_parent_items'] = array();
  $temp['menu_child_items']  = array();

  if (!empty($definitions['menus'])) {
    // Identifying parents and children, defining menu-subsets per parents,
    // calculating menu trail in this menu.
    foreach ($definitions['menus'] as $menu_id => $menu_data) {
      $temp['menu_trails'][$menu_id]       = array();
      $temp['menu_parent_items'][$menu_id] = array();
      $temp['menu_child_items'][$menu_id]  = array();

      // Each of the menuitems in a menu.
      // They get scanned and a database is being built from them.
      foreach ($menu_data['items'] as $item_id => $item_data) {
        if (!empty($item_data['parent'])) {
          // Just the fact that they are parents.
          $temp['menu_parent_items'][$menu_id][$item_data['parent']] = array();
          $temp['menu_parent_items'][$menu_id][$item_data['parent']]['items'] = array();
          // Just the fact that they are children.
          $temp['menu_child_items'][$menu_id][$item_id] =
            $definitions['menus'][$menu_id]['items'][$item_id];
        }
      }
      unset($item_id, $item_data);
      // Each of the child items in a menu:
      // They get appended to their parent items menu-subsets.
      foreach ($temp['menu_child_items'][$menu_id] as $item_id => $item_data) {
        $temp['menu_parent_items'][$menu_id][$item_data['parent']]['items'][$item_id] = $item_data;
      }
      if (!empty($request['page_id'])) {
        // Calculating the menu trail for this menu.
        _track_menu_trail($menu_id, $request['page_id']);
        // Use every element only once.
        // (NOTE: this might not give appropriate enough results in some special
        // cases, though...)
        $temp['menu_trails'][$menu_id]
          = array_keys(array_flip($temp['menu_trails'][$menu_id]));
      }
    }
  }
}

function _track_menu_trail($menu_id, $item_id) {
  global $definitions, $request, $temp;

  $temp['menu_trails'][$menu_id][] = $item_id;
  if (!empty($definitions['menus'][$menu_id]['items'][$item_id]['parent'])) {
    $found_parent = $definitions['menus'][$menu_id]['items'][$item_id]['parent'];
    $temp['menu_trails'][$menu_id][] = $found_parent;
    _track_menu_trail($menu_id, $found_parent);
  }
}

function _render_menu_level($menu_id, $depth, $menu_level_data) {
  global $temp;

  if ($depth == 1) {
    $menu_attribs_raw = array(
      'class' => array(
        'menu',
      ),
    );
    if (!empty($menu_level_data['menu_options']['attributes'])) {
      $menu_attribs_raw =
        array_merge_recursive($menu_attribs_raw, $menu_level_data['menu_options']['attributes']);
    }
  }
  else {
    $menu_attribs_raw = array();
  }
  $menu_attribs_string = templateutils_render_html_attributes($menu_attribs_raw);
  $output = '<ul' . $menu_attribs_string . '>';

  // Go through menu items.
  foreach ($menu_level_data['items'] as $item_id => $item_data) {
    $children_depth = $item_data['depth'] + 1;
    $place_in_trail = array_search($item_id, $temp['menu_trails'][$menu_id]);
    // Preparing template argument placeholders.
    $menu_item = array(
      'variables' => array(),
    );
    $link_data = array(
      'variables' => array(),
    );

    // LINK type menu item.
    if ($item_data['depth'] == $depth && $item_data['type'] == 'link') {
      // Preparing attributes.
      $link_attributes = array(
        'href' => base_path() . $item_data['path'],
        'class' => array(
          'menu__link',
          'menu__button',
        ),
      );
      if (isset($item_data['title'])) {
        $link_attributes['title'] = $item_data['title'];
      }
      $wrapper_attributes = array(
        'class' => array(
          'menu__item',
          'depth--' . ensafe_string($depth),
        ),
      );
      if (!empty($item_data['link_options']['attributes'])) {
        $link_attributes =
          array_merge_recursive($link_attributes, $item_data['link_options']['attributes']);
      }
      if (!empty($item_data['wrapper_options']['attributes'])) {
        $wrapper_attributes =
          array_merge_recursive($wrapper_attributes, $item_data['wrapper_options']['attributes']);
      }
      if ($place_in_trail === 0) {
        $link_attributes['class'][] = 'active';
      }
      elseif (!empty($place_in_trail)) {
        $link_attributes['class'][] = 'active-trail';
        $wrapper_attributes['class'][] = 'active-trail';
      }
      if (!empty($item_data['item_options']['active_trail_when'])) {
        $at_instruction = $item_data['item_options']['active_trail_when'];
        if (array_key_exists('section', $at_instruction)
            && !empty($GLOBALS['request']['sections'])) {
          if (in_array($at_instruction['section'], $GLOBALS['request']['sections'])) {
            $link_attributes['class'][] = 'active-trail';
            $wrapper_attributes['class'][] = 'active-trail';
          }
        }
        // Should we do the same for the contexts? We shall see.
      }
      // Start rendering items.
      $menu_item['meta'] = array(
        'menu_id' => $menu_id,
      );
      $menu_item['template_name'] = 'menu_item';
      $menu_item['wrapper_options']['attributes'] = $wrapper_attributes;
      $menu_item['variables']['link_attributes'] =
        templateutils_render_html_attributes($link_attributes);
      $menu_item['variables']['link_text'] = ensafe_string($item_data['text']);

      if (!empty($temp['menu_parent_items'][$menu_id][$item_id])) {
        $menu_item['variables']['element_children'] =
          _render_menu_level($menu_id, $children_depth, $temp['menu_parent_items'][$menu_id][$item_id]);
        $wrapper_attributes['class'][] = 'has-children';
      }
      else {
        $menu_item['variables']['element_children'] = '';
      }

      $output .= templateutils_present($menu_item);
    }
    // STATIC menu item.
    elseif ($item_data['depth'] == $depth && $item_data['type'] == 'static') {
      // Preparing attributes.
      $wrapper_attributes = array(
        'class' => array(
          'menu__item',
          'menu__item--static',
          'depth--' . ensafe_string($depth),
        ),
      );
      if (!empty($place_in_trail)) {
        $wrapper_attributes['class'][] = 'active-trail';
      }
      if (!empty($item_data['wrapper_options']['attributes'])) {
        $wrapper_attributes =
          array_merge_recursive($wrapper_attributes, $item_data['wrapper_options']['attributes']);
      }
      // Start rendering items.
      if (!empty($temp['menu_parent_items'][$menu_id][$item_id])) {
        $menu_item['variables']['element_children'] =
         _render_menu_level($menu_id, $children_depth, $temp['menu_parent_items'][$menu_id][$item_id]);
        $wrapper_attributes['class'][] = 'has-children';
      }
      else {
        $menu_item['variables']['element_children'] = '';
      }
      $menu_item['template_name'] = 'static_menu_item';
      $menu_item['wrapper_options']['attributes'] = $wrapper_attributes;
      $menu_item['variables']['item_text'] = ensafe_string($item_data['text']);
      $output .= templateutils_present($menu_item);
    }
  }
  unset($item_id, $item_data);
  $output .= '</ul>';
  return $output;
}

