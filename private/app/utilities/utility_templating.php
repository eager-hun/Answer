<?php
/**
 * @file
 * Templating utilities.
 *
 * print '<pre>'; var_dump($var); print '</pre>';
 */

/**
 * Data dresser.
 *
 * It organizes the calls for templateutils_present() on behalf of binders and
 * entities.
 */
function templateutils_data_dresser($args, $advanced_opts = array()) {

  // Being safe by having fallback values for important args.
  $default_advanced_opts = array(
    'data_source' => 'temp',
  );
  // FIXME: look out for array_merge behavior! Will it be compatible with
  // any kind of values, merge intents? I suspect it might need more attention.
  $advanced_opts = array_merge($default_advanced_opts, $advanced_opts);

  $data_source = $advanced_opts['data_source'];

  // Render an entity.
  if ($args['data_type'] == 'entity' && $data_source == 'temp') {
    if ($GLOBALS['temp']['data_statuses'][$args['instance_id']] != '200') {
      // Something was up with this content and data_fetcher() did not
      // leave data for us to dress.
      return FALSE;
    }
    if (!empty($GLOBALS['temp']['raw_entities'][$args['instance_id']])) {
      $args['raw_data'] =
        $GLOBALS['temp']['raw_entities'][$args['instance_id']]['fields'];
      $args['presentation_subject'] = 'entity';
      if (!empty($args['raw_data'])) {
        return templateutils_present($args);
      }
    }
    else {
      if (is_dev_mode()) {
        $message = 'Inexistent entity <em>'
          . ensafe_string($args['instance_id'], 'attribute_value')
          . '</em> was passed in for dressing up.';
      }
      else {
        $message = 'Inexistent entity was passed in for dressing up.';
      }
      sys_notify($message, 'warning');
    }
  }
  elseif ($args['data_type'] == 'entity' && $data_source == 'args') {
    if (array_key_exists('raw_data', $args)) {
      $args['presentation_subject'] = 'entity';
      return templateutils_present($args);
    }
    elseif (is_dev_mode()) {
      sys_notify('Mishap: no raw data had been passed for data_dresser.', 'warning');
      return FALSE;
    }
  }
  // Render a binder.
  elseif ($args['data_type'] == 'binder') {
    $rendered_items  = array();
    $rendered_binder = '';
    _binder_render_recursive($args, $rendered_items, $rendered_binder);
    return $rendered_binder;
  }
  else {
    sys_notify('Unrecognized task for data dresser.', 'warning');
  }
}

/**
 * Recursive binder renderer.
 */
function _binder_render_recursive($args, &$items_buffer, &$result) {
  // FIXME: how doesn't it accumulate while processing unrelated binder
  // definitions??? It does? It looks like as if it does.
  static $inception = 0;

  if (!empty($GLOBALS['definitions']['binders'][$args['instance_id']])) {
    $binder_definition = $GLOBALS['definitions']['binders'][$args['instance_id']];
  }
  else {
    sys_notify('Data dresser could not find the definitions for the requested binder.', 'alert');
    $result = FALSE;
    return;
  }
  foreach ($binder_definition['items'] as $item) {
    if ($item['data_type'] == 'entity') {
      if (should_content_show($item)
          && !empty($GLOBALS['temp']['raw_entities'][$item['instance_id']]['fields']['field_body']['field_content'])) {
        $items_buffer[$item['instance_id']] = templateutils_data_dresser($item);
      }
    }
    elseif ($item['data_type'] == 'binder') {
      $inception++;
      if ($inception < 40) {
        $nested_items = array();
        _binder_render_recursive($item, $nested_items, $result);
        if (!empty($nested_items)) {
          $item['raw_data'] = $nested_items;
          $item['presentation_subject'] = 'binder';
          $items_buffer[$item['instance_id']] = templateutils_present($item);
        }
      }
      else {
        $message = 'Nesting depth of binders has blown the limiter fuse, aborting.'
                 . "<br>Tip: review your binder definitions to find the cause for excessive binder nesting.";
        sys_notify($message, 'warning');
        $args['raw_data'] = $items_buffer;
        $args['presentation_subject'] = 'binder';
        $result = templateutils_present($args);
        return;
      }
    }
    elseif ($item['data_type'] == 'current_page_primary_content') {
      if (!empty($GLOBALS['request']['page_data'])) {
        // The renderer will be able to use much of $request's page_data.
        $render_args_for_prim = $GLOBALS['request']['page_data'];
        // Appending further rendering options.
        $render_args_for_prim['wrapper_options'] = array(
          'attributes' => array(
            'id'       => 'primary-content',
            'class'    => array('primary-content'),
            'tabindex' => '-1',
          ),
        );
        $render_args_for_prim['flag_primary_content'] = TRUE;

        if ($render_args_for_prim['data_type'] == 'binder') {
          // If the primary content is a binder, we store it with its instance
          // name.
          // TODO: finding out why I had to do this and why it wont't break.
          $items_buffer[$render_args_for_prim['instance_id']] =
            templateutils_data_dresser($render_args_for_prim);
        }
        elseif ($render_args_for_prim['data_type'] == 'entity') {
          // Sorting out the right presentation_agent for the entity.
          $pa_full = $render_args_for_prim['entity_type'] . '_full';
          if (!empty($item['present_as'])) {
            $render_args_for_prim['present_as'] = $item['present_as'];
          }
          elseif (empty($item['present_as'])
              && !empty($GLOBALS['registry']['known_presentation_agents'])
              && in_array($pa_full, $GLOBALS['registry']['known_presentation_agents'])) {
            $render_args_for_prim['present_as'] = $pa_full;
          }
          // If the primary content is an entity, we store it with an alias of
          // 'page_primary_content'.
          // TODO: finding out why I had to do this and why it wont't break.
          $items_buffer['page_primary_content'] =
            templateutils_data_dresser($render_args_for_prim);
        }
      }
    }
    else {
      $message = 'Error: unrecognized data type was passed for data dresser.';
      sys_notify($message, 'alert');
    }
  }
  $args['raw_data'] = $items_buffer;
  $args['presentation_subject'] = 'binder';
  $result = templateutils_present($args);
}

/**
 * Present data.
 */
function templateutils_present($args) {
  // Default output is HTML (as opposed to JSON, which, in the future, should
  // also be an option).
  if (!array_key_exists('output_type', $args)) {
    $args['output_type'] = 'html';
  }
  // Some templates offer variable HTML tag for the wrapper; here we make sure
  // they receive an argument as default.
  if (empty($args['variables']['wrapper_html_tag'])) {
    $args['variables']['wrapper_html_tag'] = 'div';
  }
  // Binders and entities do definitely need a presentation agent to sort them
  // out. If none had been specified yet, let's specify a default for them.
  if (empty($args['present_as'])
      && !empty($args['presentation_subject'])
      && ($args['presentation_subject'] == 'binder' || $args['presentation_subject'] == 'entity')) {
    $args['present_as'] = 'automatic_inventory';
  }
  // Making sure that the wrapper options infrastructure is ready to use, but
  // also keep possible earlier declarations.
  if (!array_key_exists('wrapper_options', $args)) {
    $args['wrapper_options'] = array();
    $args['wrapper_options']['attributes'] = array();
    $args['wrapper_options']['attributes']['class'] = array();
  }
  elseif (!array_key_exists('attributes', $args['wrapper_options'])) {
    $args['wrapper_options']['attributes'] = array();
    $args['wrapper_options']['attributes']['class'] = array();
  }
  elseif (!array_key_exists('class', $args['wrapper_options']['attributes'])) {
    $args['wrapper_options']['attributes']['class'] = array();
  }

  // Item signatures (a.k.a. HTML classes for the wrapper tag).
  if (!empty($args['presentation_subject'])) {
    $args['wrapper_options']['attributes']['class'][] =
      ensafe_string($args['presentation_subject'], 'attribute_value');
    if ($args['presentation_subject'] == 'entity') {
      $item_signature_type = $args['presentation_subject'] . '--' . $args['entity_type'];
      $args['wrapper_options']['attributes']['class'][] =
        ensafe_string($item_signature_type, 'attribute_value');
    }
    $item_signature_id = $args['presentation_subject'] . '--' . $args['instance_id'];
    $args['wrapper_options']['attributes']['class'][] =
      ensafe_string($item_signature_id, 'attribute_value');
  }

  // This is the time for the presentation agent, if one was appointed.
  if (!empty($args['present_as'])) {
    apputils_wake_resource('presentation_agent', $args['present_as']);
    $presentation_agent_func = 'pa_' . $args['present_as'];

    // Running present agent on the data.
    if (function_exists($presentation_agent_func)) {
      $presentation_agent_func($args);
    }
    else {
      // Fallback function is 'automatic_inventory'.
      apputils_wake_resource('presentation_agent', 'automatic_inventory');
      pa_automatic_inventory($args);
    }

    // If the template is a layout, then load the layout definition now and
    // learn its properties.
    if (strpos($args['template_name'], 'layout_') === 0) {
      $args['presentation_is_layout'] = TRUE;
      apputils_wake_resource('layout', $args['template_name']);
      // Stating the way the template is implemented (if it is a function or
      // a php_template file).
      $args['template_source'] =
        $GLOBALS['definitions']['layouts'][$args['template_name']]['template_source'];
    }
    // Implement assignments.
    if (!empty($args['variable_dispatcher_options'])) {
      templateutils_variable_dispatcher($args);
    }

    // p10n HTML class.
    $args['wrapper_options']['attributes']['class'][] = 'p10n--'
      . ensafe_string($args['present_as'], 'attribute_value');

    // Some after-effects to the template .
    $post_dispatch_func = 'post_dispatch_' . $args['template_name'];
    if (function_exists($post_dispatch_func)) {
      $post_dispatch_func($args);
    }
  }

  // More HTML class.
  $args['wrapper_options']['attributes']['class'][] = 'tpl--' .
    ensafe_string($args['template_name'], 'attribute_value');

  // Producing output.
  if (empty($args['variables'])) {
    // NOTE: with this being in place, we can not really know if there was
    // really no data to put out (empty $args['variables']), or specifying
    // template_name or presentation_agent was forgotten about.
    $output = '';
    if (is_dev_mode('verbose')) {
      $message = 'No result was returned for <em>'
        . ensafe_string($args['instance_id'], 'attribute_name') . '</em> because it did not have any variables to put out.';
      sys_notify($message, 'warning');
    }
  }
  elseif ($args['output_type'] == 'html') {
    $output = _templatize_html($args);
  }
  elseif ($args['output_type'] == 'json') {
    $output = _templatize_json($args);
  }
  else {
    sys_notify('Template agent did not understand the rendering instruction. No result were returned.', 'warning');
    $output = '';
  }

  return $output;
}

/**
 * Return data formatted as HTML.
 */
function _templatize_html($args) {
  // Template name.
  // $args['template'] should have either been provided before calling
  // templateutils_present(), or, if a presentation_agent was employed, then it
  // should have been set by the presentation_agent.
  if (!empty($args['template_name'])) {
    $template_name = $args['template_name'];
  }
  else {
    sys_notify('There was no template name specified for _templatize_html(). No result was returnded.', 'warning');
    return FALSE;
  }

  // Template source.
  if (empty($args['template_source'])) {
    // Default source is a function.
    $template_source = 'function';
  }
  else {
    $template_source = $args['template_source'];
  }


  // Preparing template variables.
  if (!empty($args['wrapper_options']['attributes'])) {
    $args['variables']['wrapper_attributes'] =
      $args['wrapper_options']['attributes'];
  }
  else {
    $args['variables']['wrapper_attributes'] = array();
  }
  // Seeking for and - if it exists - applying the customizing function.
  $customizer = 'template_customize_' . $template_name;
  if (function_exists($customizer)) {
    $customizer($args);
  }
  // Rendering the HTML attributes string.
  $args['variables']['wrapper_attributes'] =
    templateutils_render_html_attributes($args['variables']['wrapper_attributes']);

  // Function as template.
  if ($template_source == 'function') {
    $template_function = 'draw_' . $template_name;

    if (function_exists($template_function)) {
      $output = $template_function($args);
    }
    else {
      $output = FALSE;
      if (is_dev_mode()) {
        $message = 'Did not find the specified template function: <em>'
          . ensafe_string($args['template_name'], 'attribute_value') . '</em>.';
      }
      else {
        $message = 'Did not find the specified template function.';
      }
      sys_notify($message, 'warning');
    }
  }
  // PHP template file as template.
  elseif ($template_source == 'php_template') {
    $variables = $args['variables'];
    if ($args['presentation_is_layout']) {
      $template_file = $GLOBALS['registry']['app_current']['templates'] . '/layouts/'
                     . $template_name . '/' . $template_name . '.template.php';
      ob_start();
      include($template_file);
      $output = ob_get_clean();
    }
    else {
      $msg = "At the current level of development, only layouts can have php template files.";
      sys_notify($msg, 'warning');
      $output = NULL;
    }
  }
  else {
    $msg = "Currently only 'function' and 'php_template' are supported as template sources.";
    sys_notify($msg, 'warning');
    $output = NULL;
  }

  return $output;
}

/**
 * Return data formatted as JSON.
 */
function _templatize_json($args) {
  // TODO.
  sys_notify('JSON rendering is TODO. No result were returned.', 'warning');
  return;
}

/**
 * Prerender fields.
 */
function templateutils_prerender_fields($args) {
  $output = array();

  $fields = $args['raw_data'];
  $template_args = array();
  $template_args['template_name']   = 'field';
  $template_args['template_source'] = 'function';

  foreach ($fields as $field_id => $field_data) {

    // Only process the field if it actually has any content.
    // (Watch for '0' as valid content though!)
    if (!isset($field_data['field_content'])) {
      // Leave this, jump to next field.
      continue;
    }
    // Info for the template.
    $template_args['field_meta'] = array(
      'field_id'   => $field_id,
      'field_type' => $field_data['field_type'],
    );
    $template_args['wrapper_options'] = array(
      'attributes' => array(
        'class' => array(
          // Do we need to sanitize these? Could we spare doing it?
          'field_id--' . ensafe_string($field_id, 'attribute_value'),
          'field_type--' . ensafe_string($field_data['field_type'], 'attribute_value'),
        ),
      ),
    );
    $template_args['variables'] = array();

    // NOTE: Escape the label now! (if it comes through loc() then it is
    // already escaped, but there is no guarantee that it was defined via
    // loc().
    $template_args['variables']['field_label'] =
      ensafe_string($field_data['field_label'], 'html');

    // Checking for field_content_prerenders.
    $helper_func = 'field_content_prerender_' . $field_data['field_type'];
    if (function_exists($helper_func)) {
      // Getting field content on board via the corresponding content
      // prerendrer.
      $template_args['variables']['field_content'] = $helper_func($field_data);
    }
    else {
      // Field contents are ought to be already escaped by the corresponding
      // field data handler.
      $template_args['variables']['field_content'] =
        $field_data['field_content'];
    }

    // Wrapping the field content into a link, if that was asked for.
    if (array_key_exists('link_to', $field_data)) {
      $link_template = array(
        'template_name' => 'link',
        'variables' => array(
          'link_attributes' => templateutils_render_html_attributes($field_data['link_to']),
          'link_text' => $template_args['variables']['field_content'],
        ),
      );
      $template_args['variables']['field_content'] = templateutils_present($link_template);
    }

    // As per now, the template variant can be chosen as per entity; it will be
    // the same for all fields within a given entity.
    // How about postponing the possibility for various field template variants
    // within the same entity until we have a page cache (for performance
    // considerations) ?
    if (!empty($args['field_prerenderer_options']['template_variant'])) {
      $template_args['wrapper_options']['template_variant'] =
        $args['field_prerenderer_options']['template_variant'];
    }

    // Rendering the complete field now.
    $output[$field_id] = templateutils_present($template_args);
  }
  unset($field_id, $field_data);
  return $output;
}

/**
 * Slot/variable dispatcher.
 *
 * Collects the final strings of contents into $args['variables'] so that $args
 * will be ready to consume by the template.
 */
function templateutils_variable_dispatcher(&$args) {
  $layout_slots =
    $GLOBALS['definitions']['layouts'][$args['template_name']]['slots'];

  foreach ($layout_slots as $slot_id => $slot_opts) {
    // A string variable to collect the slot's rendered content, item by item.
    $args['variables'][$slot_id] = '';
    // The present agent defined which items belong to this slot.
    if (!empty($args['variable_dispatcher_options']['assignments'][$slot_id])) {
      $slot_assigned_items = $args['variable_dispatcher_options']['assignments'][$slot_id];
      foreach($slot_assigned_items as $item_id => $item_args) {
        if (!empty($args['raw_data'][$item_id])) {
          $args['variables'][$slot_id] .= $args['raw_data'][$item_id];
        }
      }
    }
  }
  unset($slot_id, $slot_opts, $slot_assigned_items, $item_id, $item_args);
}

/**
 * Prepare HTML attributes for printing in templates.
 *
 * TODO: add option to configure which custom attribs should get what specific
 * treatment.
 */
function templateutils_render_html_attributes($attribs_array) {
  $output = '';
  foreach ($attribs_array as $attrib_name => $attrib_val) {
    if (is_array($attrib_val)) {
      if (count($attrib_val) > 0) {
        $output .= ' ' . ensafe_string($attrib_name, 'attribute_name');

        array_walk($attrib_val, 'ensafe_array_vals', 'attribute_value');
        $output .= '="' . implode(' ', $attrib_val) . '"';
      }
    }
    else {
      $output .= ' ' . ensafe_string($attrib_name, 'attribute_name');
      if ($attrib_name == 'title') {
        $output .= '="' . ensafe_string($attrib_val) . '"';
      }
      elseif ($attrib_name == 'alt') {
        $output .= '="' . ensafe_string($attrib_val) . '"';
      }
      elseif ($attrib_name == 'href') {
        $output .= '="' . ensafe_string($attrib_val, 'href') . '"';
      }
      elseif ($attrib_name == 'src') {
        $output .= '="' . ensafe_string($attrib_val, 'href') . '"';
      }
      elseif ($attrib_name == 'style') {
        $output .= '="' . ensafe_string($attrib_val, 'css') . '"';
      }
      else {
        $output .= '="' . ensafe_string($attrib_val, 'attribute_value') . '"';
      }
    }
  }
  return $output;
}


/**
 * Read the external list of known presentation_agents.
 */
function templateutils_import_pa_cache(&$registry) {
  $cache_file = $registry['app_current']['cache'] . '/cache_presentation_agents.txt';
  if (file_exists($cache_file)) {
    $pa_s = file_get_contents($cache_file);
    $registry['known_presentation_agents'] = preg_split("/\r\n|\n|\r/", $pa_s);
  }
  else {
    sys_notify("Error: the application could not find the present agents' cache.", 'warning');
  }
}
