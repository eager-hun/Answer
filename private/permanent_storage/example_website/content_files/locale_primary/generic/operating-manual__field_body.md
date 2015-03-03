
## Steps for initial deploy onto public server over FTP

1. place the unpacked installation into the _staging_ directory on server,
2. check `director.php`:
  - check the `@ingroup configuration` section,
3. edit `config.php`:
  - review your config presets,
  - define 'staging' as `CONFIG_PRESET`,
  - look at everything else,
      - e.g. where do you want to serve jQuery from,
4. make sure that the **admin data handler is inaccessible** to the script
   (delete or rename its directory),
5. manually test the staging site,
6. edit again `config.php`, now setting `CONFIG_PRESET` to 'live'.
7. swap `index.php` with `503_index.php`,
  - check if the maintenance message is getting served,
8. empty the live site's directory
9. copy over the now-serving-503 `index.php`,
  - optionally check the live site for the maintenance message,
10. copy over everything else from the staging directory,
11. swap back the `index.php`s so that the real one is being used,
12. test live site.

## Adding new content

**NOTE:** _all_ changes _all_ the time should be made on an isolated development machine, then the new and updated files should be copied to the public server.

This is neccessary because authoring content needs **admin&nbsp;tasks** to be used,
but these **admin&nbsp;tasks should be disabled on the public server** (because the
site _cannot make difference_ between administrators and regular visitors: and we don't
want just anybody to be able to access the admin tasks).

<!--HIGH-->

[ Make changes safely on isolated instance ] &rArr; [ Deploy files to public server ]

<!--/HIGH-->

<!--DEFS-->

- Creating a new entity

  - pick a suitable entity type for the new content,
  - in **`permanent_storage`**:
      - enter entity manifest into the chosen `records_[entity_type].php` file,
      - if neccessary (e.g. lengthy content), create external files for specific
        fields' content in `content_files`, for each desired locale,
  - check correct entity setup by requesting the entity in `bare_data` mode.

- Creating a new page

  - in **`definitions`**:
      - add the new page's definition into `definitons_pages.php`,
          - (make the `page_id` the same as the entity's `instance_id`),
  - visit the _admin interface_ and **have the path&nbsp;caches rebuilt**,
  - check correct page setup by requesting the new paths (for each locale).

- Adding new menu items

  - in **`definitions`**:
      - add the new menu-item definitions in each desired locale's
        `definitions_menus_[...].php` files,
          - (make the menu `item_id` the same as the `page_id` it is pointing
            to),
  - check on the pages if the new menu items show, the links work, and `active`,
    and `active-trail` (if applicable) indications are working correctly, for
    each locale.

- Finishing touches

  - visit the _admin interface_ and have the XML sitemaps rebuilt,
  - update the `global_lastmod` value in `config.php`:
     - note that this step might be needed to be applied on the public site
       instance again, as the `config.php` should **not** be copied over upon
       deploy,
  - deploy changes onto live server.

<!--/DEFS-->

**NOTE:** Any time a page is created, or an existing page's `page_id` or `paths`
values are changed, it is neccessary to **rebuild the path&nbsp;cache** (the task
is accessible via the _admin interface_).

## Deploy local changes onto public server using FTP

<!--DEFS-->

- To update content and settings:

  - Upload from **_public_** (start with this):
      - `document_files`
          - Note: if the qantities are large here, inspecting file attribute
            `date created` might be useful for attempting a synchronization-like approach.
  - Upload from **_private_**:
      - `cache`
      - `definitions`
      - `permanent_storage`
  - Upload from **_document root_**:
      - XML sitemaps
  - Edit the remote `config.php` to update the `global_lastmod` value in it.

- To update theme:

  - Upload from **_private_**:
      - `cache` (There are theme-related caches.)
  - Upload from **_public_**:
      - `shared_assets`
      - check if `libraries_frontend` has changed too
  - Upload from the **_theme_**:
      - `css`
      - `css-static`
      - `images`
      - `js`
      - `templates` &larr; Watch out for if the theme's or the system's template dir is being used.
      - `theme_settings.php` &larr; **NOTE:** don't forget to **bump the theme&nbsp;version** in it!

<!--/DEFS-->

## Adding a new website instance to an installation

1. Duplicate the `example_website`'s directories, renaming the duplicate
   directories' names to the desired name of your new site instance (`cp -r example_website new_instance_name`), in the following locations:
  - `private/cache/`
  - `private/config/`
  - `private/definitions/`
  - `private/permanent_storage/`
2. Update the new instance's `config.php` with the new site's configuration.
3. Then set the active instance in `director.php`'s `@ingroup configuration`.
4. Check if everything works, and you have a working 'clone' of the
   `example_website`.
  - Theoretically it shouldn't be neccessary, but you may also give a go to
    visiting the _admin&nbsp;page_ (on the path you defined in the instance's
    config.php) and having path- and theme caches re-generated.
5. You can start modifying the definition- and content-related files of your
   instance to reflect your wishes.
