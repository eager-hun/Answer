<?php
/**
 * @file
 * Creating flexilists.
 */


// #############################################################################
// Preparations upon the data handler's inclusion.

apputils_wake_resource('definitions', 'flexilists');
apputils_wake_resource('definitions', 'pages');


// #############################################################################
// Standard function.

function dh_flexilist($args) {
  if (!empty($args['order_id'])) {
    $output = _create_list($args);
    return $output;
  }
  elseif (is_dev_mode()) {
    sys_notify('Unrecognized task was encountered by dh_system_helpers.', 'warning');
    return FALSE;
  }
}

function _create_list($args) {
  if (!empty($GLOBALS['definitions']['flexilists'][$args['order_id']])) {
    $def = $GLOBALS['definitions']['flexilists'][$args['order_id']];
    if ($def['data_type'] == 'entity') {
      apputils_wake_resource('permanent_data_storage', $def['entity_type']);
    }
  }
  else {
    if (is_dev_mode()) {
      $message = 'Not found the definition for flexilist <em>'
        . $args['order_id'] . '</em>.';
    }
    else {
      $message = 'Not found the definition for flexilist.';
    }
    sys_notify($message, 'warning');
    $def = array();
  }

  // List options with attributes.
  if (!array_key_exists('list_options', $def)) {
    $def['list_options'] = array();
    $def['list_options']['attributes'] = array();
    $def['list_options']['attributes']['class'] = array(
      'flexilist',
      'flexilist--' . $args['order_id'],
    );
  }
  elseif (!array_key_exists('attributes', $def['list_options'])) {
    $def['list_options']['attributes'] = array();
    $def['list_options']['attributes']['class'] = array(
      'flexilist',
      'flexilist--' . $args['order_id'],
    );
  }
  elseif (!array_key_exists('class', $def['list_options']['attributes'])) {
    $def['list_options']['attributes']['class'] = array(
      'flexilist',
      'flexilist--' . $args['order_id'],
    );
  }
  else {
    $def['list_options']['attributes']['class'][] = 'flexilist';
    $def['list_options']['attributes']['class'][] =
      'flexilist--' . $args['order_id'];
  }

  // List item options with attributes.

  if (!array_key_exists('item_options', $def)) {
    $def['item_options'] = array();
    $def['item_options']['attributes'] = array();
    $def['item_options']['attributes']['class'] = array();
  }
  elseif (!array_key_exists('attributes', $def['item_options'])) {
    $def['item_options']['attributes'] = array();
    $def['item_options']['attributes']['class'] = array();
  }
  elseif (!array_key_exists('class', $def['item_options']['attributes'])) {
    $def['item_options']['attributes']['class'] = array();
  }

  $rendered_list_attribs =
    templateutils_render_html_attributes($def['list_options']['attributes']);

  // TODO: this should be an ul > li structure, but not until the templating
  // system is being taught to change wrapper tags by options (in this case, the
  // default div wrapper of the intended list item to an ul).
  // NOTE: wrapper tag change is done, so this could be done.
  $results = '';

  foreach($def['instance_ids'] as $item) {
    $data_args = array();

    if ($def['data_type'] == 'entity'
        && !empty($GLOBALS['datapool']['permanent_data_storage'][$def['entity_type']][$item])) {
      $item_data = $GLOBALS['datapool']['permanent_data_storage'][$def['entity_type']][$item];
      // Did not supply locale info, skipping it (though notifying about it).
      if (empty($item_data['meta']['supports_locales'])) {
        if (is_dev_mode()) {
          $message = 'Listed item <em>' . $item
                   . '</em> did not declare locale support. Flexilist skips the item.';
          sys_notify($message, 'warning');
        }
        continue;
      }

      // if (! is_published ) { continue; } // FIXME.

      // Suplied locale info, but doesn't support the current language.
      elseif (!in_array(LOCALE_KEY, $item_data['meta']['supports_locales'])) {
        // TODO: the language-fallback behaviour should be working based on a
        // setting. But, for the time being, it got hardcoded.

        // Let's try to load the primary locale variant, if the entity
        // supports that one.
        if (in_array('primary', $item_data['meta']['supports_locales'])) {
          // Now I had to hax the all the descendant actions in the drivetrain
          // to look for and react to this argument.
          $data_args['fetch_locale'] = 'primary';
        }
        // No support for current locale, neither for primary, let's skip it
        // then.
        else {
          continue;
        }
      }
    }

    $data_args['data_type']       = $def['data_type'];
    $data_args['instance_id']     = $item;
    $data_args['present_as']      = $def['present_items_as'];
    $data_args['wrapper_options'] = array(
      'attributes' => $def['item_options']['attributes'],
    );

    if ($def['data_type'] == 'entity') {
      $data_args['entity_type'] = $def['entity_type'];
    }
    if (!empty($def['fetch_fields'])) {
      $data_args['fetch_fields'] = $def['fetch_fields'];
    }
    $data_args['flexilist_order'] = $def;
    // Fill entities into the global $temp array.
    datautils_data_fetcher($data_args);
    // Dress data.
    $results .= templateutils_data_dresser($data_args);
  }
  unset($item);

  if (!empty($results)) {
    return '<div' . $rendered_list_attribs . ">\n" . $results . "</div>\n";
  }
  else {
    return '<div' . $rendered_list_attribs . ">\n" . loc('flexilist-empty-result') . "</div>\n";
  }
}
