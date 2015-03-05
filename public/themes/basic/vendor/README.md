Place for Ruby gems handled by and executed through Bundler.

- The desired gems are defined in the 'Gemfile' in the theme root.
- This path is not declared in any file, but can be established by using the
  `--path` argument for the `install` command when installing.
- Install gems by issuing the following command in the same directory where the
  'Gemfile' is located (the theme's root dir):

$ bundle install --path vendor/bundle

For more info, see http://bundler.io/ .

