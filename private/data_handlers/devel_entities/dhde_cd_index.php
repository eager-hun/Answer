<?php
/**
 * Custom script for the components_demo devel entity.
 */


/**
 * Standard function.
 *
 * Make its name match the file-name.
 *
 * @return string
 *   The complete rendered components demo series.
 */
function devel_entities_cd_index($args) {
  $base_path = base_path();

  /*
  Further, yet unfinished pages.
  - [Forms](${base_path}components-demo/forms)
  - [Ajax operations and modals](${base_path}components-demo/ajax-and-modals)
  */

  $page_content = <<<EOT

<!--HIGH-->

  **_Components demo groups:_**

- [Typography](${base_path}components-demo/typography)
- [In-text features](${base_path}components-demo/in-text-features)
- [Grids and flexbox layouts](${base_path}components-demo/grids-and-flexboxes)
- [Content widgets](${base_path}components-demo/content-widgets)

<!--/HIGH-->

EOT;

  return datautils_process_markdown($page_content);
}
