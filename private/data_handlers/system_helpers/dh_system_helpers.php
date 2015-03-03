<?php
/**
 * @file
 * Field handler for any system-related odd-jobs.
 */

/**
 * Standard function.
 */
function dh_system_helpers($args) {
  $function = '_' . $args['order_id'];
  if (function_exists($function)) {
    return $function($args);
  }
  elseif (is_dev_mode()) {
    $message = 'Unrecognized task was encountered by dh_system_helpers: <code>'
      . ensafe_string($args['order_id'], 'attribute_value') . '</code>';
    sys_notify($message, 'warning');
    return FALSE;
  }
}

/**
 * Response 301.
 */
function _response_301($args) {
  if (!empty($GLOBALS['request']['page_data']['new_locations'][LOCALE_KEY])) {
    $new_location =
      ensafe_string($GLOBALS['request']['page_data']['new_locations'][LOCALE_KEY], 'href');
    header($GLOBALS['request']['server_protocol'] . " 301 Moved Permanently");
    header("Location: " . $new_location);
    exit();
  }
  else {
    // Dunno.
    // TODO: check out what happens if this happens.
  }
}

/**
 * Response 403.
 */
function _response_403($args) {
  header($GLOBALS['request']['server_protocol'] . " 403 Forbidden");
  return loc('http-403');
}

/**
 * Response 404.
 */
function _response_404($args) {
  header($GLOBALS['request']['server_protocol'] . " 404 Not found");
  return loc('http-404');
}

/**
 * Response 410.
 */
function _response_410($args) {
  header($GLOBALS['request']['server_protocol'] . " 410 Gone");
  return loc('http-410');
}

/**
 * Header branding.
 */
function _header_branding($args) {
  $output = '<a class="site-name" href="' . base_path() . '">' . loc('site-name') . "</a>\n";
  if (!empty($GLOBALS['definitions']['string_translations'][LOCALE_KEY]['site-tagline-1'])) {
    $output .= '<div class="site-tagline site-tagline--1">'
      . loc('site-tagline-1') . "</div>\n";
  }
  if (!empty($GLOBALS['definitions']['string_translations'][LOCALE_KEY]['site-tagline-2'])) {
    $output .= '<div class="site-tagline site-tagline--2">'
      . loc('site-tagline-2') . "</div>\n";
  }
  return $output;
}

/**
 * Header widgets.
 */
function _header_widgets($args) {
  $output = '<a class="menu-button" href="#navigation">' . loc('Menu') . '</a>'
            . '<a class="menu-button fixed" href="#navigation">' . loc('Menu') . '</a>';
  $output .= _language_switcher('');
  return $output;
}

/**
 * Language switcher.
 */
function _language_switcher($args) {
  $attributes = array(
    'class' => array(
      'langswitch',
    ),
  );
  if (!empty($args['extra_attributes'])) {
    $attributes = array_merge_recursive($args['extra_attributes'], $attributes);
  }
  $langswitch_template = array(
    'template_name' => 'langswitch_unit',
    'wrapper_options' => array(
      'attributes' => $attributes,
    ),
    'variables' => array(),
  );
  if (!empty($GLOBALS['request']['page_id'])
      && $GLOBALS['request']['page_id'] == 'home') {
    $items = _langswitch_suggested_links($args);
    // We could add 'home-page' class to the label to give the label a 'home'
    // icon, but we don't want that on the home-page.
    array_unshift($items, '<li class="label">' . loc('Site language') . '</li>');
  }
  else {
    // If page has translation, show the translation.
    if (!empty($GLOBALS['request']['page_data']['has_translations'])) {
      $items = _langswitch_translation_links($args);
      array_unshift($items, '<li class="label has-icon translations">' . loc('Translations') . '</li>');
    }
    // Else show a suggestion (which is currently always the homepage).
    else {
      $items = _langswitch_suggested_links($args);
      $langswitch_template['variables']['pretext'] =
        '<div class="label mute pretext has-icon no-translations">'
        . loc('no-translations') . '</div>';
      array_unshift($items, '<li class="label has-icon home-page">' . loc('Home page') . '</li>');
    }
  }
  $langswitch_template['variables']['items'] = '<ul>' . implode('', $items) . '</ul>';

  return templateutils_present($langswitch_template);
}

/**
 * Language switcher suggestion.
 *
 * It's called suggestion, because most of the time it is employed when the
 * current page doesn't have a translation, then this thingy comes in, as a
 * fallback.
 *
 * In the future, it could suggest language choices for the closest definable
 * hub-page (like in jQuery's .closest()) that has multiple languages (sections
 * could be developed to give support to such a thing).
 *
 * But for now, it will always fall back to the home page, since that is the
 * easiest to implement at the moment.
 */
function _langswitch_suggested_links($args) {
  // Returning links for the defined languages of of the site.
  $items = array();
  foreach ($GLOBALS['config']['document']['locale'] as $locale_key => $locale_data) {
    $locale_class = 'locale--' . $locale_key;
    $link_attributes_raw = array(
      'class' => array('locale', $locale_class),
      'title' => loc('global-langswitch-link-title', $locale_key),
      'href'  => base_path(array('for_locale' => $locale_key)),
    );
    $link_template = array(
      'template_name' => 'langswitch_link',
      'langswitch_type' => 'suggestion',
      'variables' => array(
        'link_attributes' => templateutils_render_html_attributes($link_attributes_raw),
        'link_text' => loc('global-langswitch-link-text', $locale_key),
      ),
    );
    $items[] = '<li>' . templateutils_present($link_template) . '</li>';
  }
  unset($locale_key, $locale_data);
  return $items;
}

/**
 * Language switcher page.
 */
function _langswitch_translation_links($args) {
  $items = array();
  foreach ($GLOBALS['request']['page_data']['paths'] as $locale_key => $uri) {
    // Only provide links that represent a different locale than the one being
    // viewed right now.
    if ($locale_key != LOCALE_KEY) {
      $locale_class = 'locale--' . $locale_key;
      $link_attributes_raw = array(
        'class' => array('locale', $locale_class),
        'title' => loc('page-langswitch-long', $locale_key),
        'href'  => base_path(array('for_locale' => $locale_key))
          . $GLOBALS['request']['page_data']['paths'][$locale_key],
      );
      $link_template = array(
        'template_name' => 'langswitch_link',
        'langswitch_type' => 'page',
        'variables' => array(
          'link_attributes' => templateutils_render_html_attributes($link_attributes_raw),
          'link_text' => loc('page-langswitch-short', $locale_key),
        ),
      );
      $items[] = '<li>' . templateutils_present($link_template) . '</li>';
    }
  }
  unset($locale_key, $uri);
  return $items;
}

/**
 * Content metadata readout on the page.
 */
function _content_meta($args) {
  $template_args = array(
    'variables' => array(),
  );
  if (!empty($GLOBALS['request']['page_data'])) {
    $content_data = $GLOBALS['request']['page_data'];
    if ($content_data['data_type'] == 'entity') {
      if (!empty($GLOBALS['temp']['raw_entities'][$content_data['instance_id']])) {
        $content_fields = $GLOBALS['temp']['raw_entities'][$content_data['instance_id']]['fields'];
      }
      else {
        $content_fields = array();
      }
    }
    elseif ($content_data['data_type'] == 'binder') {
      $content_defs = $GLOBALS['definitions']['binders'][$content_data['instance_id']];
    }
  }

  if (!empty($content_fields['field_title']['field_content'])) {
    $template_args['variables']['page_title'] =
      ensafe_string($content_fields['field_title']['field_content'], 'html');
  }
  if (!empty($content_defs['binder_options']['title'][LOCALE_ID])) {
    $template_args['variables']['page_title'] =
      ensafe_string($content_defs['binder_options']['title'][LOCALE_ID], 'html');
  }
  if (!empty($content_fields['field_subtitle']['field_content'])) {
    $template_args['variables']['page_subtitle'] =
      ensafe_string($content_fields['field_subtitle']['field_content'], 'html');
  }
  if (!empty($GLOBALS['request']['page_id'])) {
    if (!empty($content_fields['field_date_created']['field_content'])) {
      $present_args = array(
        'template_name' => 'field',
        'variables' => array(
          'field_label'   => $content_fields['field_date_created']['field_label'],
          'field_content' => $content_fields['field_date_created']['field_content'],
        ),
      );
      $template_args['variables']['date_created'] =
        templateutils_present($present_args);
    }
    if (!empty($content_fields['field_date_lastmod']['field_content'])) {
      $present_args = array(
        'template_name' => 'field',
        'variables' => array(
          'field_label' => $content_fields['field_date_lastmod']['field_label'],
          'field_content' => $content_fields['field_date_lastmod']['field_content'],
        ),
      );
      $template_args['variables']['date_lastmod'] =
        templateutils_present($present_args);
    }
  }
  return draw_content_meta($template_args);
}

/**
 * Site lastmod.
 */
function _site_lastmod($args) {
  if (!empty($GLOBALS['config']['document']['global_lastmod'])) {
    $lastmod = $GLOBALS['config']['document']['global_lastmod'];
    apputils_wake_resource('data_handler', 'field_date');
    $date_args = array(
      'order' => array(
        'data' => $lastmod,
      ),
    );
    $output = '<div class="label">' . loc('website-lastmod') . "</div>\n";
    $output .= '<div>' . dh_field_date($date_args) . "</div>\n";
    return $output;
  }
}

/**
 * Sys notifications.
 */
function _sys_notifications($args) {
  // Hack.
  // It is too early to try looking at the notifications, since it is likely
  // that more than half of the contents are being processed after this call.
  // But, nevertheless, the notification-entity's placeholder with empty content
  // will get inserted into place.
  // To amend this empty return, the task_handler_page will update this value
  // right before starting rendering, thus collecting as late notifications as
  // possible.
  return;
}

/**
 * Page jump-links.
 */
function _page_jump_links($args) {
  // Single responsibility principle was not being respected in the wrapper.
  $output = '<div id="top" class="jump-links">' . "\n";
  $output .= '<a class="jump-link" href="#navigation">' . loc('Jump to menu') . "</a>\n";
  $output .= '<a class="jump-link" href="#primary-content">' . loc('Jump to content') . '</a>';
  $output .= "</div>\n";
  return $output;
}

/**
 * Prepare deprecated content for delivery.
 */
function _prepare_deprecated_content($args) {
  global $config;

  $page_data = $GLOBALS['request']['page_data'];
  $page_data['present_as'] = 'automatic_inventory';
  datautils_data_fetcher($page_data);
  // Assemble the payload.
  // TODO: it would be really nice to have templating functions for messages!
  $body_content = loc('deprecated-title')
    . '<div class="messages-container"><div class="messages warning"><ul><li>'
    . loc('deprecated-description') . '</li></ul></div></div>';
    // Wow ^^.
  $body_content .= templateutils_data_dresser($page_data);
  // TODO: another theme should be set here, instead of the following?

  // HTML document preparations.
  // Overwriting standard styles and scripts.
  $config['ui'] = array(
    'css_external' => array(
      array(
        'source' => 'theme_generated',
        'file'   => 'styles_plain_output.css',
      ),
    ),
  );
  $head_content = pageutils_html_head();
  // Render the whole HTML document.
  $template_args = array(
    'variables' => array(
      'head_content' => $head_content,
      'body_content' => $body_content,
    ),
  );
  return draw_deprecated_document($template_args);
}
