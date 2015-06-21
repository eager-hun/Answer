<?php
/**
 * Custom script for the project_1 devel entity.
 */

/**
 * Standard function.
 *
 * Make its name match the file-name.
 */
function devel_entities_project_1($args) {
  $output = '<p>This is Project 1., a placeholder project.</p>'
          . '<p>It is an entity of type <code>dynamic</code>, whose body field'
          . ' is provided by the <code>devel_entities</code> data&nbsp;handler.'
          . '</p>';
  return $output;
}
