<?php
/**
 * @file
 * Templating utilities.
 */

/**
 * Data dressing wrapper function.
 */
function templateutils_data_dresser($args) {
  // Render an entity.
  if ($args['data_type'] == 'entity') {
    if ($GLOBALS['temp']['data_statuses'][$args['instance_id']] != '200') {
      // Something was up with this content and data_fetcher() did not
      // leave data for us to dress.
      return FALSE;
    }
    if (!empty($GLOBALS['temp']['raw_entities'][$args['instance_id']])) {
      $args['raw_data'] =
        $GLOBALS['temp']['raw_entities'][$args['instance_id']]['fields'];
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
      if ($inception < 20) {
        $nested_items = array();
        _binder_render_recursive($item, $nested_items, $result);
        if (!empty($nested_items)) {
          $item['raw_data'] = $nested_items;
          $items_buffer[$item['instance_id']] = templateutils_present($item);
        }
      }
      else {
        $message = 'Nesting depth of binders has exceeded 20, aborting.'
                 . "<br>Tip: review your binder definitions to find the cause of the 'Inception overload'.";
        sys_notify($message, 'warning');
        $args['raw_data'] = $items_buffer;
        $result = templateutils_present($args);
        return;
      }
    }
    elseif ($item['data_type'] == 'current_page_primary_content') {
      if (!empty($GLOBALS['request']['page_data'])) {
        $content_data = $GLOBALS['request']['page_data'];
        $content_data['wrapper_options'] = array(
          'attributes' => array(
            'id'       => 'primary-content',
            'class'    => array('primary-content'),
            'tabindex' => '0',
          ),
        );
        if ($content_data['data_type'] == 'binder') {
          $content_data['wrapper_options']['attributes']['class'][] = 'binder';

          if (empty($content_data['present_as'])) {
            $content_data['present_as'] = 'automatic_inventory';
          }
        }
        elseif ($content_data['data_type'] == 'entity') {
          $content_data['wrapper_options']['attributes']['class'][] = 'entity';

          $pa_full = $content_data['entity_type'] . '_full';
          if (!empty($item['present_as'])) {
            $content_data['present_as'] = $item['present_as'];
          }
          elseif (empty($item['present_as'])
              && !empty($GLOBALS['registry']['known_present_agents'])
              && in_array($pa_full, $GLOBALS['registry']['known_present_agents'])) {
            $content_data['present_as'] = $pa_full;
          }
          else {
            $content_data['present_as'] = 'automatic_inventory';
          }
        }
        $content_data['this_is_primary_content'] = TRUE;
        $items_buffer[$content_data['instance_id']] =
          templateutils_data_dresser($content_data);
      }
    }
    else {
      $message = 'Error: unrecognized data type was passed for data dresser.';
      sys_notify($message, 'alert');
    }
  }
  $args['raw_data'] = $items_buffer;
  $result = templateutils_present($args);
}

/**
 * Present data.
 */
function templateutils_present($args) {
  // Default output is HTML (as opposed to JSON, that should be an option).
  if (!array_key_exists('output_type', $args)) {
    $args['output_type'] = 'html';
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

  // Some templates offer variable HTML tag for wrapper; make sure they receive
  // an argument as default.
  if (empty($args['variables']['wrapper_html_tag'])) {
    $args['variables']['wrapper_html_tag'] = 'div';
  }

  // Presenting can happen either by applying the specified a template, or the
  // specified present_agent.
  // If the template is specified, should be specified in $args['template'].
  // If the present_agent is specified, then it should be done in
  // $args['present_as'].
  if (!empty($args['present_as'])) {
    apputils_wake_resource('present_agent', $args['present_as']);
    $present_agent_func = 'pa_' . $args['present_as'];

    // Running present agent on the data.
    if (function_exists($present_agent_func)) {
      $present_agent_func($args);
    }
    else {
      // Fallback function is 'automatic_inventory'.
      apputils_wake_resource('present_agent', 'automatic_inventory');
      pa_automatic_inventory($args);
    }
    // Item signature.
    if ($args['data_type'] == 'entity') {
      $item_signature = $args['template_name'] . '--' . $args['instance_id'];
      $args['wrapper_options']['attributes']['class'][] =
        ensafe_string($item_signature, 'attribute_value');
    }
    // If the template is a layout, then load the layout definition now and
    // pass on its properties.
    if (strpos($args['template_name'], 'layout_') === 0) {
      apputils_wake_resource('layout', $args['template_name']);
      // Stating the way the template is implemented (if it is a function or
      // a template file).
      $args['template_source'] =
        $GLOBALS['definitions']['layouts'][$args['template_name']]['template_source'];
    }
    // Implement assignments.
    if (!empty($args['for_dispatcher'])) {
      templateutils_variable_dispatcher($args);
    }
    // Some after-effects to the template .
    $post_dispatch_func = 'post_dispatch_' . $args['template_name'];
    if (function_exists($post_dispatch_func)) {
      $post_dispatch_func($args);
    }
  }

  // Producing output.
  if (empty($args['variables'])) {
    // NOTE: with this being in place, we can not really know if there was
    // really no data to put out (empty $args['variables']), or specifying
    // template_name or present_agent was forgotten about.
    $output = '';
    if (is_dev_mode('verbose')) {
      $message = 'No result was returned for <em>'
        . ensafe_string($args['instance_id'], 'attribute_name') . '</em> because it did not have any variables to put out.';
      sys_notify($message, 'warning');
      /*
      ob_start();
      var_dump($args);
      $message = ob_get_clean();
      sys_notify($message, 'debug');
      */
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
  // templateutils_present(), or, if a present_agent was employed, then it
  // should have been set by the present_agent.
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

  if ($template_source == 'function') {
    $template_function = 'draw_' . $template_name;
  }
  else {
    sys_notify('Currently only functions are supported as template sources.', 'warning');
  }

  if (function_exists($template_function)) {
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
    // var_dump($field_id);
    // var_dump($field_data);
    if (empty($field_data)) {
      // var_dump($args);
    }
    // Only process the field if the it actually has any content.
    // (Watch for '0' as valid content though!)
    if (!isset($field_data['field_content'])) {
      // Leave this, jump to next field.
      continue;
    }
    // Reset on every iteration.
    $template_args['wrapper_options'] = array(
      'attributes' => array(
        'class' => array(
          'field',
          // Do we need to sanitize these? Could we spare doing it?
          'field--' . ensafe_string($field_id, 'attribute_value'),
          'field-type--' . ensafe_string($field_data['field_type'], 'attribute_value'),
        ),
      ),
    );
    $template_args['variables'] = array();

    if (!in_array('without_label', $args['field_formatter_options'])) {
      // NOTE: Escape the label now! (if it comes through loc() then it is
      // already escaped, but there is no guarantee that it was defined via
      // loc().
      $template_args['variables']['field_label'] =
        ensafe_string($field_data['field_label'], 'html');
    }
    // Pre-pre-render image fields.
    if ($field_data['field_type'] == 'image') {
      // var_dump($field_data);
      $img_template = array(
        'template_name' => 'image',
        'variables' => array(
          'attributes' =>
            templateutils_render_html_attributes($field_data['field_content']['attributes']),
        ),
      );
      $template_args['variables']['field_content'] = templateutils_present($img_template);
    }
    else {
      // Field contents are ought to be already escaped by the field data
      // handler.
      $template_args['variables']['field_content'] =
        $field_data['field_content'];
    }
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
    if (!empty($args['for_dispatcher']['assignments'][$slot_id])) {
      $slot_assigned_items = $args['for_dispatcher']['assignments'][$slot_id];
      foreach($slot_assigned_items as $item_id => $item_args) {
        if (!empty($args['raw_data'][$item_id])) {
          $args['variables'][$slot_id] .= $args['raw_data'][$item_id];
//          if ($slot_id =='main_content') {
//            var_dump($slot_id);
//            var_dump($args['for_dispatcher']['assignments'][$slot_id]);
//            var_dump($args['variables'][$slot_id]);
//          }
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
    $output .= ' ' . ensafe_string($attrib_name, 'attribute_name');
    if (is_array($attrib_val)) {
      array_walk($attrib_val, 'ensafe_array_vals', 'attribute_value');
      $output .= '="' . implode(' ', $attrib_val) . '"';
    }
    else {
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
      else {
        $output .= '="' . ensafe_string($attrib_val, 'attribute_value') . '"';
      }
    }
  }
  return $output;
}


/**
 * Read the external list of known present_agents.
 */
function templateutils_import_pa_cache(&$registry) {
  $cache_file = $registry['app_current']['cache'] . '/cache_present_agents.txt';
  if (file_exists($cache_file)) {
    $pa_s = file_get_contents($cache_file);
    $registry['known_present_agents'] = preg_split("/\r\n|\n|\r/", $pa_s);
  }
  else {
    sys_notify("Error: the application could not find the present agents' cache.", 'warning');
  }
}
