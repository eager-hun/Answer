# Howto: install


## System prerequisites

### Hard dependency

- [Apache webserver with php module][amp]

### Soft dependencies

- [Composer package manager][composer]
  - (For the ease of downloading php libraries. (The customized autoloader it
    provides is not utilized in this project.))
- [Node.js runtime environment][nodejs]
  - [Bower package manager][bower]
      - (For the ease of downloading frontend libraries.)
- [Ruby execution environment][ruby]
  - [Bundler package manager][bundler]
      - (Installer and execution manager for Ruby gems - these are used only for theme
        development.)


## Installation process

Obligatory **WARNING 1**: never start getting introduced to this project on
a publicly accessible server; instead, familiarize yourself with
security-related procedures on an isolated developer machine.

Obligatory **WARNING 2**: If you don't know what you are doing, then don't
continue:
- learn first about Apache, PHP, and - especially - about node.js (with extra
  focus on how it behaves the operating system that you want to use it on).
- and make sure you understand the basic concepts of web security.

This is NOT an exhaustive instruction, and guaranteeing your system's safety is
out of its scope.

### To the first valid response

- Place the working tree into an Apache virtualhost.
- Check in browser: you should see a warning about an
  "unrecognized domain name".
- Edit config.php (/private/config/example_website/config.php):
  - In the 'Config Presets' section, edit the domain names for your various
    environments (`HTTP_HOST` in `phpinfo()`'s output) (initial emphasis is on
    the 'dev' preset).
- Check in browser: a webpage should start forming by now.

### Installing dependencies

- **php libraries**
  - follow instructions in /private/libraries_backend/README.md
  - edit config.php's 'Dependencies' section:
      - remove the `$config['app']['dependencies']` declarations with the
        `FALSE` values,
      - uncomment the prepared declarations for the same variables, below.
- **frontend libraries**
  - the majority:
      - follow instructions in /public/libraries_frontend/README.md
  - getting modernizr.js:
      - open /public/themes/basic/theme_settings.php,
      - find inline comment to the modernizr.com website,
      - visit link, download the custom compiled file,
      - place into /public/shared_assets/js/ directory,
      - make sure that the filename and the definition in theme_settings.php
        match.

### Optional: installing Ruby themer tools

- Follow instructions in /public/themes/basic/vendor/README.md


[amp]: https://www.apachefriends.org/
[composer]: https://getcomposer.org/
[nodejs]: http://nodejs.org/
[bower]: http://bower.io/
[ruby]: https://www.ruby-lang.org/en/downloads/
[bundler]: http://bundler.io/
