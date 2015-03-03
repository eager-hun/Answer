<?php
/**
 * Menu definitions for primary locale.
 */

// #############################################################################
// Főmenü.

$menus['main_menu'] = array(
  'menu_options' => array(
    'attributes' => array(
      'class' => array(
        'nav-format--regular'
      ),
    ),
  ),
  'items' => array(
    'home' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => '',
      'text'   => 'Kezdőlap',
      // 'title'  => 'Kezdőlap',
    ),
    'articles-all' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'cikkek/',
      'text'   => 'Cikkek',
      // 'title'  => 'Cikkek',
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
      'path'   => 'kepek/',
      'text'   => 'Képek',
      // 'title'  => 'Képek',
      'item_options' => array(
        'active_trail_when' => array(
          'section' => 'images_all',
        ),
      ),
    ),
  ),
);


// #############################################################################
// Lábléc menü.

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
      'text'   => 'Kezdőlap',
      // 'title'  => 'Kezdőlap',
    ),
    'articles-all' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'cikkek/',
      'text'   => 'Cikkek',
      // 'title'  => 'Cikkek',
    ),
    'images-all' => array(
      'depth'  => 1,
      'parent' => FALSE,
      'type'   => 'link',
      'path'   => 'kepek/',
      'text'   => 'Képek',
      // 'title'  => 'Képek',
      'item_options' => array(
        'active_trail_when' => array(
          'section' => 'images_all',
        ),
      ),
    ),
  ),
);
