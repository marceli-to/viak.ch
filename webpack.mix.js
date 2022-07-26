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

// Frontend: CSS
mix.sass('resources/sass/app.scss', 'public/assets/css/app.css').options({processCssUrls: false}).version();

// Frontend: global.js
mix.js('resources/js/vanilla/app.js', 'public/assets/js/app.js');

// Frontend: filter.js
mix.js('resources/js/vue/modules/course/filter/Index.js', 'public/assets/js/filter.js').version();

// Frontend: Student register.js & profile.js
mix.js('resources/js/vue/modules/student/register/Index.js', 'public/assets/js/student/register.js').version();
mix.js('resources/js/vue/modules/student/profile/Index.js', 'public/assets/js/student/profile.js').version();
mix.js('resources/js/vue/modules/student/basket/Index.js', 'public/assets/js/student/basket.js').version();

// Frontend: Expert profile.js
mix.js('resources/js/vue/modules/expert/profile/Index.js', 'public/assets/js/expert/profile.js').version();

// Frontend: Checkout
mix.js('resources/js/vue/modules/checkout/Index.js', 'public/assets/js/global/checkout.js').version();

// Backend
mix.js('resources/js/vue/modules/dashboard/app.js', 'public/assets/js/dashboard/app.js').version();