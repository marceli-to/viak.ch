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
mix.js('resources/js/vue/modules/filter/Index.js', 'public/assets/js/global/filter.js').version();

// Frontend: checkout.js
mix.js('resources/js/vue/modules/checkout/Index.js', 'public/assets/js/global/checkout.js').version();

// Frontend: basket.js
mix.js('resources/js/vue/modules/basket/Index.js', 'public/assets/js/global/basket.js').version();

// Frontend: bookmarks.js
mix.js('resources/js/vue/modules/bookmark/Index.js', 'public/assets/js/global/bookmark.js').version();

// Frontend: register.js
mix.js('resources/js/vue/modules/register/Index.js', 'public/assets/js/global/register.js').version();

// Frontend: Student profile.js
// mix.js('resources/js/vue/modules/student/profile/Index.js', 'public/assets/js/student/profile.js').version();

// Frontend: Expert profile.js
mix.js('resources/js/vue/modules/expert/profile/Index.js', 'public/assets/js/expert/profile.js').version();

// Backend: Administrator
mix.js('resources/js/vue/modules/dashboard/App.js', 'public/assets/js/dashboard/app.js').version();

// Backend: Student
mix.js('resources/js/vue/modules/student/App.js', 'public/assets/js/student/app.js').version();
