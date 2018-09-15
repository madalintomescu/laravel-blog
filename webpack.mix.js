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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/dashboard.js', 'public/js')
    .sass('resources/sass/dashboard.scss', 'public/css')
    .js('resources/js/image_preview.js', 'public/js')
    .js('resources/js/select2.js', 'public/js')

mix.copyDirectory('resources/js/plugins/summernote', 'public/js/plugins/summernote');
mix.copy('resources/img/no-image.png', 'storage/app/public/avatars/no-image.png');
