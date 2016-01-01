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
// Binders for SPECIFIC PAGES.

// -----------------------------------------------------------------------------
// Homepage global level - full page prototype.

$binders['full_page_prototype'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'fpp-header',
      'present_as'  => 'plain',
      // Unofficial hack. TODO: providing reliable support.
      'field_prerenderer_options' => array(
        'template_variant' => 'plain',
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'fpp-main',
      'present_as'  => 'automatic_inventory',
      // Unofficial hack. TODO: providing reliable support.
      'field_prerenderer_options' => array(
        'template_variant' => 'plain',
      ),
    ),
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'fpp-footer',
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

    /*
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
            'indications--on-right',
          ),
          'tabindex' => '-1',
        ),
      ),
    ),
    //*/

    /*
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
    //*/

  ),
);


// #############################################################################
// Binders for default pages.

// Note: the following is only neccessary if you want to have additional pages
// on the website.

$binders['page_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'binder',
      'instance_id' => 'header_default',
      'present_as'  => 'automatic_inventory',
    ),
    array(
      'data_type'   => 'binder',
      'instance_id' => 'header_suffix_default',
      'present_as'  => 'automatic_inventory',
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
      'instance_id' => 'fpp-header',
      'present_as'  => 'plain',
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
            'indications--on-right',
          ),
          'tabindex' => '-1',
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
// FOOTER.

$binders['footer_default'] = array(
  'items' => array(
    array(
      'data_type'   => 'entity',
      'entity_type' => 'dynamic',
      'instance_id' => 'fpp-footer',
      'present_as'  => 'plain',
    ),
  ),
);
