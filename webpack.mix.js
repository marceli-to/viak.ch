const mix = require('laravel-mix');

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      '@': __dirname + '/resources/js/vue/',
    },
  },
});

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

mix.sass('resources/sass/app.scss', 'public/assets/css/app.css').options({processCssUrls: false}).version();
// mix.js('resources/js/vue/app.js', 'public/assets/js/bundle.vue.js').version();
mix.js('resources/js/vanilla/app.js', 'public/assets/js/app.js');


// Frontend: filter.js
mix.js('resources/js/vue/modules/filter/Index.js', 'public/assets/js/filter.js').version();

// Frontend: register.js
mix.js('resources/js/vue/modules/register/Index.js', 'public/assets/js/register.js').version();
