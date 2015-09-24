<?php
/**
 * Custom script for the components_demo devel entity.
 */


// #############################################################################
// Actions upon inclusion.

$helpers_file = dirname(__FILE__) . '/dhde_cd_helpers.php';
if (file_exists($helpers_file)) {
  include_once($helpers_file);
}
if (function_exists('_dhde_create_dummy_list')) {
  _dhde_create_dummy_list();
}

// Assets.
// @ingroup not_sophisticated, I know.
$GLOBALS['config']['ui']['css_external'][] = array(
  'source'     => 'theme_generated',
  'file'       => 'extra_components_demo.css',
  'is_enabled' => 1,
);


/**
 * Standard function.
 *
 * Make its name match the file-name.
 *
 * @return string
 *   The complete rendered components demo series.
 */
function devel_entities_cd_grids_fbs($args) {
  return _decd_grids_fbs();
}

/**
 * Grids.
 */
function _decd_grids_fbs() {
  $registry = $GLOBALS['registry'];

  apputils_wake_resource('data_handler', 'flexilist');

  // List 1.
  $list_1_args = array(
    'order_id' => 'images_all',
  );
  $list_1_opts = array(
    'list_properties_preset' => 'default',
    'presentation_preset'    => 'default',
  );
  $list_1 = dh_flexilist($list_1_args, $list_1_opts);

  // List 2.
  $list_2_args = array(
    'order_id' => 'images_all',
  );
  $list_2_opts = array(
    'list_properties_preset' => 'default',
    'presentation_preset'    => '3-cols',
  );
  $list_2 = dh_flexilist($list_2_args, $list_2_opts);

  // Fabricating "Feature highlight"s.
  $feature_highlight_template = $registry['app_current']['templates']
    . '/layouts/layout_feature_highlight/layout_feature_highlight.template.php';
  $image_style = '1_1-280w';
  $image_path_base = $registry['app_externals']['document_files']
                   . '/images/' . $image_style . '/';

  $fh_list__items = $GLOBALS['temp']['dh_devel_entities']['cd_dummies']['dummy_list'];
  $fh_list__rendered_items = array();

  foreach ($fh_list__items as $item) {
    $image_attributes = array(
      'src' => $image_path_base . ensafe_string($item['image'], 'file_name'),
      'title' => ensafe_string($item['title']),
    );
    $image_template = array(
      'template_name' => 'image',
      'variables'     => array(
        'attributes'  => templateutils_render_html_attributes($image_attributes),
      ),
    );
    $link_attributes = array(
      'href' => $item['button_action'],
    );
    $link_template = array(
      'template_name' => 'link',
      'variables' => array(
        'link_attributes' => templateutils_render_html_attributes($link_attributes),
        'link_text'       => ensafe_string($item['button_text']),
      ),
    );
    $item_attributes = array(
      'class' => array(
        'tpl--feature_highlight',
      ),
    );
    $variables = array(
      'wrapper_attributes' => templateutils_render_html_attributes($item_attributes),
      'slot_image'  => templateutils_present($image_template),
      'slot_title'  => ensafe_string($item['title'], 'html'),
      'slot_text'   => ensafe_string($item['short_text'], 'html'),
      'slot_button' => templateutils_present($link_template),
    );
    ob_start();
    include $feature_highlight_template;
    $fh_list__rendered_items[] = '<div class="item">' . ob_get_clean() . '</div>';
  }
  unset($item);

  // $fh_list_all_items = implode("\n", $fh_list__rendered_items);
  $fh_list_2_items   = implode("\n", array_slice($fh_list__rendered_items, 0, 2));
  $fh_list_5_items   = implode("\n", array_slice($fh_list__rendered_items, 0, 5));

  $list_3 = '<div class="l--flexbox l--flexbox--auto-row">';
  $list_3 .= $fh_list_2_items;
  $list_3 .= '</div>';

  $list_4 = '<div class="l--flexbox l--flexbox--cols-3">';
  $list_4 .= $fh_list_5_items;
  $list_4 .= '</div>';

  $list_5 = '<div class="l--flexbox l--flexbox--cols-3 flexbox--equal-width">';
  $list_5 .= $fh_list_5_items;
  $list_5 .= '</div>';

  $demo = '<h2 class="cd">Matrix, float, 4 columns</h2>' . $list_1
        . '<h2 class="cd">Matrix, float, 3 columns</h2>' . $list_2
        . '<h2 class="cd">Flexbox single row "auto stuffer", with <code>display: table;</code> fallback</h2>'
        . '<p class="description">The listed items in this demo are "Feature highlight" components.</p>'
        . $list_3
        . '<h2 class="cd"><span class="anchor" id="anchor--flexbox-multirow"></span>Flexbox 3-col multi row, with floated grid fallback</h2>'
        . '<ul class="description">'
        . '<li>If the number of items and the number of columns are not divisible without remainder, then the items in the last row will distribute automatically to use all room.</li>'
        . '<li>The listed items in this demo are "Feature highlight" components.</li>'
        . '</ul>'
        . $list_4
        . '<h3><span class="anchor" id="anchor--flexbox-multirow--equal-width"></span>Flexbox 3-col multi row variant: equal-width columns</h3>'
        . $list_5;

  return $demo;
}
