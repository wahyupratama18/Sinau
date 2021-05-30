const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('public_html/');
mix.js('resources/js/app.js', 'js')
    .postCss('resources/css/app.css', 'css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

mix.js('resources/js/pinterapp.js', 'js')
    .postCss('resources/css/pinterapp.css', 'css', [
        require('postcss-import'),
        // require('bootstrap')
    ])

if (mix.inProduction()) {
    mix.version();
}
