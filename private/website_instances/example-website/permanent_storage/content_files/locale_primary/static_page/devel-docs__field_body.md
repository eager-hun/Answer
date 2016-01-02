
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

TODO: documenting.


## <span class="anchor" id="anchor--new-entity-to-pages"></span>Adding a new entity to pages

TODO: documenting.


## <span class="anchor" id="anchor--prototyping-components"></span>Quick prototyping: page components

See _Project 1._ in the developer's menu (available in the primary locale, in dev_mode).


## <span class="anchor" id="anchor--prototyping-page"></span>Quick prototyping: a page

There is a new "Full Page Prototype" repository (FPP-for-Answer) in my GitHub account that aims to assist in this.

The "Operating manual" (found in the "Misson control" menu) provides further info on "Working with website instances".
