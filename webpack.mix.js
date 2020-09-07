const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/custom.js', 'public/admin_side/js')
    .js('resources/js/front/front.js', 'public/front_side/js/front.js')
    .js('resources/js/front/cart.js', 'public/front_side/js/cart.js')
    .js('resources/js/front/profile.js', 'public/front_side/js/profile.js')
    .react('resources/js/ReactTable.js', 'public/admin_side/js')
    .sass('resources/sass/app.scss', 'public/css');
