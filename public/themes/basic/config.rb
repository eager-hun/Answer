# Hack/quickfix:
# See: https://github.com/Compass/compass/issues/1851
# See: https://github.com/Compass/compass/issues/1868#issuecomment-62783187
require 'compass/import-once/importer'
module Compass::ImportOnce::Importer
  def find(uri, options, *args)
    uri, force_import = handle_force_import(uri.gsub(/^\(NOT IMPORTED\) /, ''))
    maybe_replace_with_dummy_engine(super(uri, options, *args), options, force_import)
  end
end

require 'compass/import-once/activate'

# Require any additional compass plugins here.
require 'sass-css-importer'
require 'breakpoint'
require 'singularitygs'

# Set this to the root of your project when deployed.
http_path       = '/'

css_dir         = 'css'
sass_dir        = 'sass'
images_dir      = 'images'
javascripts_dir = 'js'
extensions_dir  = 'sass-extensions'

# Preferred output style (can be overridden via the command line).
# output_style = :expanded or :nested or :compact or :compressed
output_style = :expanded

# To enable relative paths to assets via Compass helper functions.
relative_assets = true

# Debugging.
line_comments = false
sourcemap     = true

# Alternative locations for resources.
add_import_path '../../shared_assets/sass'
add_import_path Sass::CssImporter::Importer.new('../../libraries_frontend/normalize.css')

# Misc.
# My Compass had a problem loading its modules, and it turned out to be
# cache-related.
cache = false
