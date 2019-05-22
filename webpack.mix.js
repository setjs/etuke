let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js/backend.js').version();
mix.sass('resources/assets/sass/app.scss', 'public/assets/css/backend.css').version();

mix.js('resources/assets/frontend/js/app.js', 'public/js/frontend.js').version();
mix.sass('resources/assets/frontend/sass/app.scss', 'public/assets/css/frontend.css').version();
