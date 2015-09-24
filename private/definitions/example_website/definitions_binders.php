<?php
/**
 * Binder definitions.
 *
 * A binder binds multiple items into a bundle that then can be placed into
 * a slot of a layout.
 *
 * The bound items may be entities, or, also other binders. The limit on the
 * level of possible binder nesting is currently set to 20, from code (not
 * adjustable).
 *
 * Each bound item should have a 'presence' property: it [should/will be]
 * evaluated before the bound item would or would not be included in a package,
 * depending on the given 'presence' setting and the current circumstances.
 *
 * Presence argument patterns:
 *
 * @code
 *
 * // For global presence (presenting the item regardless of any condition):
 * // NOTE: such declaration can even be omitted, as the default presence
 * // evaluation is TRUE (the items show up by default).
 * 'presence' => array(
 *   'global' => 'global',
 * ),
 *
 * // For specified presence:
 * 'presence' => array(
 *   'variable'  => 'page_id', // page_id || context || section.
 *   'condition' => 'is_not',  // is || is_not.
 *   'value'     => 'home',
 * ),
 *
 * @endcode
 */


// #############################################################################
// Binders for the default page.

$binders['page_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'binder',
      'instance_id' => 'header_default',
      'present_as'  => 'automatic_inventory',
      'wrapper_options' => array(
        'attributes' => array(
          'class' => array('region', 'region--header'),
        ),
      ),
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'header_suffix_default',
      'present_as'  => 'automatic_inventory',
      'wrapper_options' => array(
        'attributes' => array(
          'class' => array('region', 'region--header_suffix'),
        ),
      ),
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'content_level_default',
      'present_as'  => 'content_level_default',
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'footer_default',
      'present_as'  => 'automatic_inventory',
      'wrapper_options' => array(
        'attributes' => array(
          'class' => array('region', 'region--footer'),
        ),
      ),
    ),
  ),
);

// -----------------------------------------------------------------------------
// HEADER.

$binders['header_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'header_branding',
      'present_as'  => 'block',
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'header_widgets',
      'present_as'  => 'block',
    ),
  ),
);
$binders['header_suffix_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'sys_notifications',
      'present_as'  => 'block',
    ),
  ),
);

// -----------------------------------------------------------------------------
// CONTENT LEVEL.

$binders['content_level_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'binder',
      'instance_id' => 'primary_content',
      'present_as'  => 'plain',
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'sidebar_1_default',
      'present_as'  => 'plain',
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'sidebar_2_default',
      'present_as'  => 'plain',
    ),
  ),
);

// -----------------------------------------------------------------------------
// PRIMARY CONTENT.

$binders['primary_content'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'content_meta',
      'present_as'  => 'block',
    ),
    array(
      'data_type'   => 'current_page_primary_content',
    ),
  ),
);

// -----------------------------------------------------------------------------
// SIDEBAR 1.

$binders['sidebar_1_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'main-menu',
      'present_as'  => 'block',
      'wrapper_options' => array(
        'attributes' => array(
          'id'       => 'navigation',
          'class'    => array(
            'block--menu',
            'is--title-hidden',
            'indications--on-right',
          ),
          'tabindex' => '-1',
        ),
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'components_demo_menu',
      'present_as'  => 'block',
      'wrapper_options' => array(
        'attributes' => array(
          'class'    => array(
            'block--menu',
            'indications--on-right',
          ),
        ),
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'mission-control-menu',
      'present_as'  => 'block',
      'wrapper_options' => array(
        'attributes' => array(
          'class'    => array(
            'block--menu',
            'indications--on-right',
          ),
        ),
      ),
      'presence' => array(
        'variable'  => 'context',
        'condition' => 'is',
        'value'     => 'admin',
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'developers-menu',
      'present_as'  => 'block',
      'wrapper_options' => array(
        'attributes' => array(
          'class'    => array(
            'block--menu',
            'indications--on-right',
          ),
        ),
      ),
      'presence' => array(
        'variable'  => 'context',
        'condition' => 'is',
        'value'     => 'admin',
      ),
    ),
  ),
);

// -----------------------------------------------------------------------------
// SIDEBAR 2.

$binders['sidebar_2_default'] = array(
  'items' => array(

  ),
);

// -----------------------------------------------------------------------------
// FOOTER.

$binders['footer_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'footer-menu',
      'present_as'  => 'block',
      'wrapper_options' => array(
        'attributes' => array(
          'class' => array(
            'block--menu',
            'is--title-hidden',
          ),
        ),
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'site-lastmod',
      'present_as'  => 'block',
    ),
  ),
);


// #############################################################################
// Binders for PAGE SUB-TYPES.

// -----------------------------------------------------------------------------
// Page template with plain look and contents.

$binders['page_plain'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'sys_notifications',
      'present_as'  => 'block',
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'content_meta',
      'present_as'  => 'block',
    ),
    array(
      'data_type'   => 'current_page_primary_content',
    ),
  ),
);


// #############################################################################
// Binders for SPECIFIC PAGES.

// -----------------------------------------------------------------------------
// Homepage global level.

$binders['page_homepage'] = array(
  'items' => array(
    array(
      'data_type'   => 'binder',
      'instance_id' => 'header_default',
      'present_as'  => 'automatic_inventory',
      'wrapper_options' => array(
        'attributes' => array(
          'class' => array('region', 'region--header'),
        ),
      ),
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'header_suffix_default',
      'present_as'  => 'automatic_inventory',
      'wrapper_options' => array(
        'attributes' => array(
          'class' => array('region', 'region--header_suffix'),
        ),
      ),
    ),
    array(
      'data_type'   => 'current_page_primary_content',
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'footer_default',
      'present_as'  => 'automatic_inventory',
      'wrapper_options' => array(
        'attributes' => array(
          'class' => array('region', 'region--footer'),
        ),
      ),
    ),
  ),
);

// -----------------------------------------------------------------------------
// Homepage content level.

$binders['mosaic_homepage'] = array(
  'binder_options' => array(
    'title' => array(
      'locale_primary'   => 'Welcome to this website',
      'locale_secondary' => 'Üdvözlet ezen a webhelyen',
    ),
  ),
  'items' => array(
    array(
      'data_type'   => 'binder',
      'instance_id' => 'sidebar_1_default',
      'present_as'  => 'plain',
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'content_meta',
      'present_as'  => 'block',
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'static_page',
      'instance_id' => 'home',
      'present_as'  => 'block',
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'articles-top',
      'present_as'  => 'block',
    ),
  ),
);


// #############################################################################
// PROTOTYPING: Binders for a SINGLE MOCK PAGE.

/**
 * NOTES:
 *
 * What do prototypes do here? Why isn't there a "prototyping" site instance,
 * where all sorts of prototyping could be compactly contained?
 *
 * Indeed that is the intention, and the possibility for it is theoretically
 * already open.
 *
 * But it would mean two different sites to maintain - in this very early,
 * refactor-heavy period of time. Changes to the config system? There would be
 * multiple config files to update. Changes to how definitions work? Multiple
 * sets of definitions to maintain. Not good.
 *
 * So, until the procedures get a bit polished up, a little prototyping is being
 * smuggled into this example_website instance.
 */

// -----------------------------------------------------------------------------
// "Single Mock Page" global level.

$binders['single_mock_page'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'smp-header',
      'present_as'  => 'plain',
      // Unofficial hack. TODO: providing reliable support.
      'field_prerenderer_options' => array(
        'template_variant' => 'plain',
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'smp-main',
      'present_as'  => 'automatic_inventory',
      // Unofficial hack. TODO: providing reliable support.
      'field_prerenderer_options' => array(
        'template_variant' => 'plain',
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'smp-layout-plan',
      'present_as'  => 'automatic_inventory',
      // Unofficial hack. TODO: providing reliable support.
      'field_prerenderer_options' => array(
        'template_variant' => 'plain',
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'smp-footer',
      'present_as'  => 'plain',
      // Unofficial hack. TODO: providing reliable support.
      'field_prerenderer_options' => array(
        'template_variant' => 'plain',
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'sys_notifications',
      'present_as'  => 'block',
    ),
  ),
);
