
<!--HIGH-->

**_Topics:_**

- [Working without app security](#anchor--working-without-app-security)
- [Working with dynamic entities](#anchor--dynamic-entities)
- [Adding a new entity to pages](#anchor--new-entity-to-pages)
- [Quick prototyping: page components](#anchor--prototyping-components)
- [Quick prototyping: a page](#anchor--prototyping-page)

<!--/HIGH-->

## <span class="anchor" id="anchor--working-without-app-security"></span>Working without app security

In various use-cases - one example being working on CSS on one's local machine - one might wish for the snappiest app responses possible.

At the time of writing, disabling the Htmlpurifier lib can result in script times dropping nearly to one tenth.

Of course, one should be cautious about disabling Htmlpurifier, but in local development environments it could be done, and the app is helping in it. The steps to do it are the following:

1. In `director.php`'s "Post-config adjustments" section, uncomment the `apputils_disable_htmlpurifier()` function call.
2. In `config.php`'s "Config Presets" section, activate the `give_up_security` switch within the `dev` environment's presets.


## <span class="anchor" id="anchor--dynamic-entities"></span>Working with dynamic entities

TODO: documenting


## <span class="anchor" id="anchor--new-entity-to-pages"></span>Adding a new entity to pages

TODO: documenting


## <span class="anchor" id="anchor--prototyping-components"></span>Quick prototyping: page components

See _Project 1._ in the developer's menu (available in the primary locale, in dev_mode).


## <span class="anchor" id="anchor--prototyping-page"></span>Quick prototyping: a page

### Turning the homepage into a mock page

- In `definitions_pages.php`, uncomment the "alternative homepage" entry, right after the original homepage declaration,
- In `config.php`, set `$config['theme']['name']` to 'smp_theme',
- Now you should see a prepared mock page as the homepage of the site.

### Notes about the theme

- Expand `smp_theme` (`/public/themes/smp_theme`) to your needs, or use a better
  one instead of it.
- Don't forget to start the themeing work with **copying the system's templates
  into the prototype theme**, and update the corresponding setting in
  `config.php`. (See `/public/themes/smp_theme/templates/README`.)

### Modifying the page prototype

- Modifying the page components (e.g. header, main bit, footer):
  - These components are implemented as custom entities. Head over to
    `/private/data_handlers/standard/dh_devel_entities` data handler, and find
    the corresponding files:
      - `devel_entities_smp_header.php`,
      - `devel_entities_smp_main.php`,
      - `devel_entities_smp_footer.php`,
  - You are free to create any markup here by any means for these components.
- Modifying the global page template markup:
  - you can find the page's template here:
    `templates/layouts/layout_single_mock_page/layout_single_mock_page.template.php`.
- Adding further components to the page:
  - You can add new entities or binders to the page in
    `definitions_binders.php`'s `single_mock_page` entry.
  - You will likely need to assign these new items to specific slots of the
    layout (in order for them to show up); you can do that in
    `templates/presentation_agents/pa_single_mock_page.php`.
  - You can create new slots for the page template in
    `templates/layouts/layout_single_mock_page/layout_single_mock_page.php`.
    (If you add/rename slots, don't forget to reassign items in the presentation
    agent.)

