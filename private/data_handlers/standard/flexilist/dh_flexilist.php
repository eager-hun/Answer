<?php
/**
 * @file
 * Creating flexilists.
 *
 * Desired features:
 *
 * - If a list of entities are requested:
 *   a) let me have an array of results, either:
 *     - an array of raw field data, or
 *     - an array of rendered entities,
 *   b) let me have a single string: the rendered entities concatenated, wrapped
 *      in a list component, complete with title, prefix, suffix, and such.
 * - If a list of anything else than entities are requested:
 *   - take pride in incompleteness and return false.
 */


// Preparations upon the data handler's inclusion.
apputils_wake_resource('definitions', 'flexilists');
// Homework: finding out why we have to wake up page defs for this.
apputils_wake_resource('definitions', 'pages');


/**
 * Standard function.
 *
 * @param array $args
 *   - data_type,
 *   - instance_id,
 *   - etc.
 * @param array $advanced_opts
 *   - 'result_format', possible values:
 *     - 'array_of_items_raw_data',
 *     - 'array_of_items_rendered',
 *     - 'rendered_component'.
 * @return mixed
 */
function dh_flexilist($args, $advanced_opts = array()) {
  if (!empty($args['order_id'])) {

    // Being safe by having fallback values for important args.
    $default_advanced_opts = array(
      'result_format'          => 'rendered_component',
      'list_properties_preset' => 'default',
      'presentation_preset'    => 'default',
      'fallback_HTML_markup'   => 'div', // Unfinished feat.
      'items_fallback_pa'      => 'automatic_inventory',
    );
    // FIXME: look out for array_merge behavior! Will it be compatible with
    // any kind of values, merge intents? I suspect it might need more
    // attention.
    $advanced_opts = array_merge($default_advanced_opts, $advanced_opts);

    return _flexilist_build_list($args, $advanced_opts);
  }
  elseif (is_dev_mode()) {
    sys_notify('Unrecognized task was encountered by dh_flexilist.', 'warning');
    return FALSE;
  }
}

/**
 * Providing results.
 *
 * TODO: a rendered list should be able to be a semantic ul > li structure,
 * (instead of just divs). This is progressing as the flexilist definition
 * is now designed to hold a 'list_HTML_markup' arg among the presentation
 * presets.
 */
function _flexilist_build_list($args, $advanced_opts) {

  $result_format = $advanced_opts['result_format'];
  $results = array();
  $error = FALSE;

  // "Importing" the flexilist definition.
  // (So that we know how to satisfy the order).
  if (!empty($GLOBALS['definitions']['flexilists'][$args['order_id']])) {
    $def = $GLOBALS['definitions']['flexilists'][$args['order_id']];
  }
  else {
    if (is_dev_mode()) {
      $message = 'Error: not found the definition for flexilist <em>'
        . $args['order_id'] . '</em>.';
    }
    else {
      $message = 'Error: not found the definition for flexilist.';
    }
    sys_notify($message, 'warning');
    return FALSE;
  }

  if ($def['data_type'] != 'entity') {
    sys_notify('NOTE: at the moment, flexilist can list only entities.', 'warning');
    return FALSE;
  }


  // ###########################################################################
  // Ensuring usable definitions for various processing parts.

  // ---------------------------------------------------------------------------
  // Preparing list arguments.

  $minimal_list_instruction = array(
    // There are no mandatory args yet, everything is optional.
  );
  // No property arguments were provided, or the requested preset doesn't exist.
  if (!array_key_exists('presets_list_properties', $def)
      || !array_key_exists($advanced_opts['list_properties_preset'], $def['presets_list_properties'])) {
    $fallback_list_properties = $minimal_list_instruction;
    $use_fallback_props = TRUE;
  }

  // ---------------------------------------------------------------------------
  // Preparing presentation arguments.

  // Providing some values for indispensable args.
  $minimal_presentation = array(
    'list_HTML_markup' => 'div', // Unimplemented.
    'present_items_as' => $advanced_opts['items_fallback_pa'],
  );

  // No presentation arguments were provided, or the requested preset doesn't
  // exist.
  if (!array_key_exists('presets_presentation', $def)
      || !array_key_exists($advanced_opts['presentation_preset'], $def['presets_presentation'])) {
    $fallback_presentation = $minimal_presentation;
    $use_fallback_prez = TRUE;
  }
  // No HTML markup was specified.
  elseif(empty($def['presets_presentation'][$advanced_opts['presentation_preset']]['list_HTML_markup'])) {
    $def['presets_presentation'][$advanced_opts['presentation_preset']]['list_HTML_markup'] =
      $advanced_opts['fallback_HTML_markup'];
  }
  // No presentation agent was specified.
  elseif(empty($def['presets_presentation'][$advanced_opts['presentation_preset']]['present_items_as'])) {
    $def['presets_presentation'][$advanced_opts['presentation_preset']]['present_items_as'] =
      $advanced_opts['items_fallback_pa'];
  }

  // ---------------------------------------------------------------------------
  // Adding back the all the finalized args to the $def.
  if (!empty($use_fallback_props)) {
    $def['list_properties'] = $fallback_list_properties;
  }
  else {
    $def['list_properties'] =
      $def['presets_list_properties'][$advanced_opts['list_properties_preset']];
  }
  if (!empty($use_fallback_prez)) {
    $def['presentation'] = $fallback_presentation;
  }
  else {
    $def['presentation'] =
      $def['presets_presentation'][$advanced_opts['presentation_preset']];
  }


  // ###########################################################################
  // Preparing the list templates.

  // If it is not raw data that is requested, then the items will have to be
  // rendered; so let's prepare.
  if ($result_format != 'array_of_items_raw_data') {
    // Preparing wrapper attributes array for list items.
    // TODO: find out what kind of array merge or union could implement the
    // following better.
    if (!array_key_exists('item_options', $def['presentation'])) {
      $def['presentation']['item_options'] = array();
      $def['presentation']['item_options']['attributes'] = array();
      $def['presentation']['item_options']['attributes']['class'] = array();
    }
    elseif (!array_key_exists('attributes', $def['presentation']['item_options'])) {
      $def['presentation']['item_options']['attributes'] = array();
      $def['presentation']['item_options']['attributes']['class'] = array();
    }
    elseif (!array_key_exists('class', $def['presentation']['item_options']['attributes'])) {
      $def['presentation']['item_options']['attributes']['class'] = array();
    }
  }

  // Preparing the rendered_component output type.
  if ($result_format == 'rendered_component') {
    // Preparing wrapper attributes array for the list wrapper.
    // TODO: find out what kind of array merge or union could implement the
    // following better.
    $list_wrapper_default_classes = array(
      'flexilist',
      'flexilist--' . $args['order_id'],
    );
    if (!array_key_exists('list_options', $def['presentation'])) {
      $def['presentation']['list_options'] = array();
      $def['presentation']['list_options']['attributes'] = array();
      $def['presentation']['list_options']['attributes']['class'] =
        $list_wrapper_default_classes;
    }
    elseif (!array_key_exists('attributes', $def['presentation']['list_options'])) {
      $def['presentation']['list_options']['attributes'] = array();
      $def['presentation']['list_options']['attributes']['class'] =
        $list_wrapper_default_classes;
    }
    elseif (!array_key_exists('class', $def['presentation']['list_options']['attributes'])) {
      $def['presentation']['list_options']['attributes']['class'] =
        $list_wrapper_default_classes;
    }
    else {
      $def['presentation']['list_options']['attributes']['class'] =
        array_merge_recursive(
          $list_wrapper_default_classes,
          $def['presentation']['list_options']['attributes']['class']
        );
    }

    // Rendering the list wrapper's attributes.
    $rendered_list_attribs =
      templateutils_render_html_attributes($def['presentation']['list_options']['attributes']);
  }


  // ###########################################################################
  // This is the point when a "query" could happen (in our case (given the data
  // storage and our special fetching method) this query still wouldn't amount
  // to more than an array of ids to include among the results at this point).

  // That's easy now, anyways, because those to-be-included id's are now
  // hardcoded in the definitions of the flexilists.

  // In the future, I'd like to have an admin task that would scan entity
  // records, and create/update a number of "cache files" that would contain
  // id's of to-be-included entities for various "queries".


  // ###########################################################################
  // Producing results.

  if ($def['data_type'] == 'entity') {
    // Ensuring the system has the list items' actual data.
    apputils_wake_resource('permanent_data_storage', $def['entity_type']);
    _flexilist_produce_results_of_entities($args, $def, $advanced_opts, $results, $error);
  }

  if (!empty($error)) {
    $message = 'dh_flexilist encountered an - as for now, unspecified - error.';
    sys_notify($message, 'warning');
    return FALSE;
  }

  if ($result_format == 'rendered_component') {
    if (count($results) > 0) {
      // TODO: this seems to be where we might use the info supplied in the
      // 'list_HTML_markup' arg.
      return '<div' . $rendered_list_attribs . ">\n" . implode('', $results) . "</div>\n";
    }
    else {
      return '<div' . $rendered_list_attribs . ">\n" . loc('flexilist-empty-result') . "</div>\n";
    }
  }
  else {
    return $results;
  }
}

/**
 * Produce results for a list of entities.
 */
function _flexilist_produce_results_of_entities($args, $def, $advanced_opts, &$results, &$error) {
  $result_format = $advanced_opts['result_format'];

  foreach($def['instance_ids'] as $item) {
    $item_data = array();

    // Deciding if including the item or skipping it; and if including, then in
    // what locale.
    if (!empty($GLOBALS['datapool']['permanent_data_storage'][$def['entity_type']][$item])) {
      // This is the raw entity manifest data, with all the metadata and
      // potentially with multiple locale variants, and external file
      // references.
      $item_data = $GLOBALS['datapool']['permanent_data_storage'][$def['entity_type']][$item];

      // if (! is_published && ! admin_mode()) { continue; } // FIXME.
      // Wow, ^^ this needs attention. NOTE: the data_fetcher seem to return
      // FALSE if this happens.

      // Did not supply locale info, skipping it (though notifying about it).
      if (empty($item_data['meta']['supports_locales'])) {
        if (is_dev_mode()) {
          $message = 'Listed item <em>' . $item
                   . '</em> did not declare locale support. Flexilist skipped the item.';
          sys_notify($message, 'warning');
        }
        continue;
      }
      // Suplied locale info, but doesn't support the current language.
      elseif (!in_array(LOCALE_KEY, $item_data['meta']['supports_locales'])) {
        // TODO: the language-fallback behaviour should be working based on a
        // setting. But, for the time being, it got hardcoded.

        // Let's try to load the primary locale variant, if the entity
        // supports that one.
        if (in_array('primary', $item_data['meta']['supports_locales'])) {
          $item_data['fetch_locale'] = 'primary';
        }
        // No support for current locale, neither for primary, let's skip it
        // then.
        else {
          continue;
        }
      }
    }
    else {
      if (is_dev_mode()) {
        $msg = 'Flexilist did not find the entity manifest for <code>'
             . $item . '</code> of entity type <code>' . $def['entity_type']
             . '</code>.';
        sys_notify($msg, 'warning');
      }
      continue;
    }

    // Preparing argument for the data_fetcher.
    $item_data['data_type']   = $def['data_type'];
    $item_data['entity_type'] = $def['entity_type'];
    $item_data['instance_id'] = $item;
    $item_data['present_as']  = $def['presentation']['present_items_as'];

    if (!empty($def['list_properties']['fetch_fields'])) {
      // The data_fetcher can restrain itself to fetch only the requested
      // fields.
      $item_data['fetch_fields']  = $def['list_properties']['fetch_fields'];
    }

    // Items won't be rendered.
    if ($result_format == 'array_of_items_raw_data') {
      $fetcher_options = array(
        'entity_data_handling' => 'return',
      );
      $entity_data = datautils_data_fetcher($item_data, $fetcher_options);
      // The fetcher - for different reasons - could return FALSE.
      // So let's watch out.
      // (Also watch out: can $entity_data be int 0, or similarly tricky?)
      if (!empty($entity_data)) {
        // Question: should we make the result contain the metadata too, or
        // should we extract only the fields?
        $results[] = $entity_data['fields'];
      }
      unset($entity_data);
    }
    // Items need to be rendered.
    elseif ($result_format == 'array_of_items_rendered'
            || $result_format == 'rendered_component') {
      // The data_fetcher will put this entity into the global $temp array, for
      // the data_dresser (the renderer utility) to pick it up from there.
      datautils_data_fetcher($item_data);

      // FIXME: the meaning of flexilist_order here is alike "ordering a pizza";
      // it's not about the order of the results.
      // It will go in the presentation agent, and tehere will say that the
      // dh_flexilist orders that so and so is done such and such way.
      // It needs a less confusing name.
      $item_data['flexilist_order'] = $def['list_properties'];
      $item_data['wrapper_options'] = array(
        'attributes' => $def['presentation']['item_options']['attributes'],
      );

      // Dress data, then append to the results array.
      //
      // As of now, the dresser gets entity data from the global $temp array;
      // if however anything is up with the entity (e.g. the fetcher did not
      // fetch it properly, for e.g. an entity 403 reason), the dresser will
      // return FALSE.
      // Perhaps the data_dresser will need to be updated too to be able to work
      // with directly passed in to-be-dressed data (so that we can fetch such
      // way that the raw array is sent here, then look into value, and do a
      // skip here if neccessary - or, if all is well, pass the raw array to the
      // upgraded dresser from here).
      //
      // Alternative way of keeping FALSE values out of the $results:
      $rendered_entity = templateutils_data_dresser($item_data);
      // (Watch out: can $entity_data be int 0, or similarly tricky?)
      if (!empty($rendered_entity)) {
        $results[] = $rendered_entity;
      }
      unset($rendered_entity);
    }
  }
  unset($item);
}