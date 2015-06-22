<?php
/**
 * Helper actions for the components demo.
 */

/**
 * Actions upon inclusion.
 */
$GLOBALS['temp']['dh_devel_entities']['cd_dummies'] = array();

/**
 * Create a dummy list for multiple purposes.
 */
function _dhde_create_dummy_list() {
  $standard_long_text = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat neque sed velit bibendum semper.</p><p>Vivamus consequat elementum mi eu porta. Morbi in metus at quam porttitor tristique ut non tellus. Mauris non quam facilisis, rhoncus elit quis, tincidunt felis. Morbi dignissim mi sed bibendum ultrices. Aliquam id tincidunt diam.</p>';

  $dummy_list = array(
    array(
      'image'       => 'sample-image.png',
      'title'       => 'Proin quis',
      'short_text'  => 'Aliquam convallis odio ligula, a faucibus velit sodales et.',
      'long_text'   => $standard_long_text,
      'button_text' => 'Duis nec purus',
      'button_url'  => '#',
    ),
    array(
      'image'       => 'sample-image.png',
      'title'       => 'Cras interdum placerat',
      'short_text'  => 'Aliquam convallis odio ligula, a faucibus velit sodales et. Pellentesque urna risus, viverra in aliquam sed.',
      'long_text'   => $standard_long_text,
      'button_text' => 'Duis nec purus',
      'button_url'  => '#',
    ),
    array(
      'image'       => 'sample-image.png',
      'title'       => 'Duis viverra',
      'short_text'  => '<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae.</p><p>Aliquam convallis odio ligula, a faucibus velit sodales et.</p>',
      'long_text'   => $standard_long_text,
      'button_text' => 'Duis nec purus',
      'button_url'  => '#',
    ),
    array(
      'image'       => 'sample-image.png',
      'title'       => 'Aliquam nisl augue',
      'short_text'  => 'Aliquam convallis odio ligula, a faucibus velit sodales et. Pellentesque urna risus, viverra in aliquam sed.',
      'long_text'   => $standard_long_text,
      'button_text' => 'Duis nec purus',
      'button_url'  => '#',
    ),
    array(
      'image'       => 'sample-image.png',
      'title'       => 'Proin velit',
      'short_text'  => 'Fusce tristique elit vel mi varius vulputate. Phasellus auctor ullamcorper ultrices sed.',
      'long_text'   => $standard_long_text,
      'button_text' => 'Duis nec purus',
      'button_url'  => '#',
    ),
    array(
      'image'       => 'sample-image.png',
      'title'       => 'Aliquam nisl augue',
      'short_text'  => 'Aliquam convallis odio ligula, a faucibus velit sodales et. Pellentesque urna risus, viverra in aliquam sed.',
      'long_text'   => $standard_long_text,
      'button_text' => 'Duis nec purus',
      'button_url'  => '#',
    ),
  );

  $GLOBALS['temp']['dh_devel_entities']['cd_dummies']['dummy_list'] = $dummy_list;
}
