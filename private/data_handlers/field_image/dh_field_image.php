<?php
/**
 * @file
 * Field handler for image type fields.
 *
 * @see
 * https://dev.opera.com/articles/native-responsive-images/#variable-width-images
 * https://dev.opera.com/articles/responsive-images/
 */

// Standard function.
function dh_field_image($args) {

  $style = $args['field_defs']['style'];

  // HTML 4 <img>, for a start.
  $src = $GLOBALS['registry']['app_externals']['document_files']
    . '/images/' . escape_value($style, 'path_fragment') . '/'
    . escape_value($args['field_data'], 'file_name');
  $image_definition = array(
    'attributes' => array(
      'src'   => $src,
    ),
  );
  $output = array(
    'field_type'    => 'image',
    'field_label'   => $args['field_defs']['label'],
    'field_content' => $image_definition,
  );
  return $output;
}

/**
 * Field content prerender.
 *
 * templateutils_prerender_fields() will look for and will call this function
 * when it deals with image fields.
 */
function field_content_prerender_image($field_data) {
  $img_template = array(
    'template_name' => 'image',
    'variables' => array(
      'attributes' =>
        templateutils_render_html_attributes($field_data['field_content']['attributes']),
    ),
  );
  return templateutils_present($img_template);
}
