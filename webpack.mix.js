const mix = require('laravel-mix');
const globImporter = require('node-sass-glob-importer');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .sass('resources/sass/public.scss', 'public/css', {
    additionalData:
      '$ENV_company-brand-color-main:' + process.env.INFO_COMPANY_COLOR_MAIN + '; ' +
      '$ENV_company-brand-color-second:' + process.env.INFO_COMPANY_COLOR_SECOND + ';',
    sassOptions: {
      importer: globImporter(),
    }
  })
  .sass('resources/sass/private.scss', 'public/css', {
    additionalData:
      '$ENV_company-brand-color-main:' + process.env.INFO_COMPANY_COLOR_MAIN + '; ' +
      '$ENV_company-brand-color-second:' + process.env.INFO_COMPANY_COLOR_SECOND + ';',
    sassOptions: {
      importer: globImporter(),
    }
  })
  .options({
    legacyNodePolyfills: false,
    processCssUrls: false
  })
  .sourceMaps(false, 'source-map');

mix
  .copy('resources/static/js/**/*.js', 'public/static/js')
  .copy('resources/static/css/**/*.css', 'public/static/css')
  .copy('resources/static/fonts', 'public/static/fonts');

mix
  .js('resources/js/public.js', 'public/js')
  .js('resources/js/private.js', 'public/js')
  .sourceMaps(false, 'source-map');

mix
  .js('resources/js/vue/app.js', 'public/js/vue')
  .js('resources/js/vue/app-router.js', 'public/js/vue')
  .vue()
  .sourceMaps(false, 'source-map');

mix.browserSync({
  proxy: process.env.BROWSERSYNC_PROXY_URL,
  port: process.env.BROWSERSYNC_PORT,
  open: false,
  files: [
    'app/**/*.php',
    'resources/views/**/*.php',
    'public/js/**/*.js',
    'public/css/**/*.css'
  ],
  watchOptions: {
    usePolling: true,
    interval: 100
  }
});
