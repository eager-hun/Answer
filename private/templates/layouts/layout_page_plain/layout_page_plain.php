<?php
/**
 * Layout.
 */

/**
 * Layout definition.
 */
$definitions['layouts']['layout_page_plain'] = array(
  'template_source' => 'php_template',
  'slots' => array(
    'slot_body_start'    => array(),
    'slot_page_content'  => array(),
    'slot_body_end'      => array(),
  ),
);

/**
 * Post-dispatch interventions.
 */
function post_dispatch_layout_page_plain(&$args) {
  // Applying body attributes.
  $args['wrapper_options']['attributes'] = array_merge_recursive(
    $args['wrapper_options']['attributes'],
    $GLOBALS['temp']['raw_attributes']['body']
  );

  // Throwing out all styles.
  pageutils_reset_styles();
  // Throwing out all scripts.
  pageutils_reset_javascripts();

  // Applying the custom plain-page stylesheet.
  $GLOBALS['config']['ui']['css_external'][] = array(
    'source'     => 'theme_generated',
    'file'       => 'extra_styles_plain_output.css',
    'is_enabled' => 1,
  );
}
