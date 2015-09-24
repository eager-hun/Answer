<?php
/**
 * Menu definitions for primary locale.
 */

// #############################################################################
// Main menu.

$menus['main_menu'] = array(
  'menu_options' => array(
    'attributes' => array(
      'class' => array(
        'nav-format--regular',
      ),
    ),
  ),
  'items' => array(
    'home' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => '',
      'text'   => 'Home',
      // 'title'  => 'Home',
    ),
    'articles-all' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'articles/',
      'text'   => 'Articles',
      // 'title'  => 'Articles',
      'item_options' => array(
        'active_trail_when' => array(
          'section' => 'articles_all',
        ),
      ),
    ),
    'images-all' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'images/',
      'text'   => 'Images',
      // 'title'  => 'Images',
      'item_options' => array(
        'active_trail_when' => array(
          'section' => 'images_all',
        ),
      ),
    ),
  ),
);


// #############################################################################
// Footer menu.

$menus['footer_menu'] = array(
  'menu_options' => array(
    'attributes' => array(
      'class' => array(
        'nav-format--button-row'
      ),
    ),
  ),
  'items' => array(
    'home' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => '',
      'text'   => 'Home',
      // 'title'  => 'Home',
    ),
    'articles-all' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'articles/',
      'text'   => 'Articles',
      // 'title'  => 'Articles',
      'item_options' => array(
        'active_trail_when' => array(
          'section' => 'articles_all',
        ),
      ),
    ),
    'images-all' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'images/',
      'text'   => 'Images',
      // 'title'  => 'Images',
      'item_options' => array(
        'active_trail_when' => array(
          'section' => 'images_all',
        ),
      ),
    ),
    'components_demo' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'components-demo/',
      'text'   => 'Components demo',
      // 'title'  => 'Components demo',
      'item_options' => array(
        'active_trail_when' => array(
          'section' => 'components_demo',
        ),
      ),
    ),
  ),
);


// #############################################################################
// Admin and developer's menus.

// Components demo.
$menus['components_demo_menu'] = array(
  'menu_options' => array(
    'attributes' => array(
      'class' => array(
        'nav-format--regular',
        'variant--light',
      ),
    ),
  ),
  'items' => array(
    'cd_typography' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'components-demo/typography',
      'text'   => 'Typography',
    ),
    'cd_in_text' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'components-demo/in-text-features',
      'text'   => 'In-text features',
    ),
    /*
    'cd_forms' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'components-demo/forms',
      'text'   => 'Forms',
    ),
    */
    'cd_grids_fbs' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'components-demo/grids-and-flexboxes',
      'text'   => 'Grids & flexboxes',
    ),
    'cd_content_widgets' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'components-demo/content-widgets',
      'text'   => 'Content-widgets',
    ),
    /*
    'cd_ajax_modals' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'components-demo/ajax-and-modals',
      'text'   => 'Ajax and modals',
    ),
    */
  ),
);

// Mission control.
$menus['mission_control_menu'] = array(
  'menu_options' => array(
    'attributes' => array(
      'class' => array(
        'nav-format--regular',
        'variant--light',
      ),
    ),
  ),
  'items' => array(
    'mc-operating-manual' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'mission-control/operating-manual',
      'text'   => 'Operating manual',
    ),
    'admin-interface' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => $GLOBALS['config']['app']['admin_path'],
      'text'   => 'Admin interface',
      'item_options' => array(
        'attributes' => array( // Apparently unimplemented. TODO.
          'id' => 'menu-item--admin',
        ),
      ),
    ),
    'mc-planning-outline' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'mission-control/site-outline-planning',
      'text'   => 'Planning: site outline',
    ),
    'mc-planning-taxonomy' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'mission-control/taxonomy-planning',
      'text'   => 'Planning: taxonomy',
    ),
  ),
);

// Developer's menu.
$menus['developers-menu'] = array(
  'menu_options' => array(
    'attributes' => array(
      'class' => array(
        'nav-format--regular',
        'variant--light',
      ),
    ),
  ),
  'items' => array(
    'devel-docs' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'devel/documentation-for-developers',
      'text'   => 'Developer documentation',
    ),
    'development' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'static',
      'text'   => 'Development',
    ),
    // >>> DEPTH 2 >>>
    'devel-project-1' => array(
      'depth'  => 2,
      'parent' => 'development',
      'type'   => 'link',
      'path'   => 'devel/project-1',
      'text'   => 'Project 1',
    ),
  ),
);


// #############################################################################
// (developer's) CSS-tuner menu.

/*
$menus['menu_developer_menu'] = array(
  'menu_options' => array(
    'attributes' => array(
      'class' => array(
        'nav-format--regular',
      ),
    ),
  ),
  'items' => array(
    'home' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'    => '',
      'text'   => 'Home At vero eos et accusam et justo',
    ),
    'level-1-static' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'static',
      'text'   => 'E level-1 static',
    ),
    'level-1-link-2' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'    => 'asdf',
      'text'   => 'E link again',
    ),
    // >>> DEPTH 2 >>>
    'level-2-link' => array(
      'depth'  => 2,
      'parent' => 'level-1-link-2',
      'type'   => 'link',
      'path'    => 'asd',
      'text'   => 'Home',
    ),
    'level-2-static' => array(
      'depth'  => 2,
      'parent' => 'level-1-link-2',
      'type'   => 'static',
      'text'   => 'E level-2 static',
    ),
    'level-2-link-2' => array(
      'depth'  => 2,
      'parent' => 'level-1-link-2',
      'type'   => 'link',
      'path'    => 'asdf',
      'text'   => 'E link again',
    ),
    'level-2-static-2' => array(
      'depth'  => 2,
      'parent' => 'level-1-link-2',
      'type'   => 'static',
      'text'   => 'E level-2 static 2',
    ),
    // >>> DEPTH 3 >>>
    'level-3-link' => array(
      'depth'  => 3,
      'parent' => 'level-2-static-2',
      'type'   => 'link',
      'path'    => 'adsf',
      'text'   => 'Home',
    ),
    'level-3-static' => array(
      'depth'  => 3,
      'parent' => 'level-2-static-2',
      'type'   => 'static',
      'text'   => 'E level-3 static',
    ),
    'level-3-link-2' => array(
      'depth'  => 3,
      'parent' => 'level-2-static-2',
      'type'   => 'link',
      'path'    => 'asdf',
      'text'   => 'E Lorem ipsum dolor sit amet, consetetur',
    ),
    // >>> DEPTH 4 >>>
    'level-4-link' => array(
      'depth'  => 4,
      'parent' => 'level-3-link-2',
      'type'   => 'link',
      'path'    => 'asdf',
      'text'   => 'Home',
    ),
    'level-4-static' => array(
      'depth'  => 4,
      'parent' => 'level-3-link-2',
      'type'   => 'static',
      'text'   => 'E level-4 static',
    ),
    'articles_all' => array(
      'depth'  => 4,
      'parent' => 'level-3-link-2',
      'type'   => 'link',
      'path'    => 'articles/',
      'text'   => 'E Articles Lorem ipsum dolor sit amet, consetetur',
    ),
  ),
);
*/
