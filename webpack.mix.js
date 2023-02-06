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

// Frontend: /vanilla/app.js
mix.js('resources/js/vanilla/app.js', 'public/assets/js/app.js');

// Frontend: /vue/app.js
mix.js(
  [
    'resources/js/vue/frontend/event/Index.js',
    'resources/js/vue/frontend/filter/Index.js',
    'resources/js/vue/frontend/checkout/Index.js'
  ],
  'public/assets/js/global/app.js')
.version();

// Frontend: register.js
mix.js(
  'resources/js/vue/frontend/register/Index.js',
  'public/assets/js/global/register.js'
).version();

// Frontend: newsletter.js
mix.js(
  'resources/js/vue/frontend/newsletter/Index.js', 
  'public/assets/js/global/newsletter.js'
).version();

// Backend: Administrator
mix.js(
  'resources/js/vue/backend/dashboard/App.js',
  'public/assets/js/dashboard/app.js'
).version();

// Backend: Expert
mix.js(
  'resources/js/vue/backend/expert/App.js',
  'public/assets/js/expert/app.js'
).version();

// Backend: Student
mix.js(
  'resources/js/vue/backend/student/App.js',
  'public/assets/js/student/app.js'
).version();
