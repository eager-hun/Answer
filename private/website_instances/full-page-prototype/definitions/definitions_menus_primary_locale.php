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
    ),
    'fpp-layouts-demo' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'layouts-demo',
      'text'   => 'Layouts demo',
    ),
  ),
);

// #############################################################################
// Admin and developer's menus.

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
  ),
);


