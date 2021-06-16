const mix = require('laravel-mix');
require("laravel-mix-svelte")

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

mix.js('resources/js/app.js', 'public/js')
    // @ts-ignore
    .svelte({
        dev: !mix.inProduction()
    })
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ])
    .webpackConfig({
        output: {
            chunkFilename: 'js/[name].js?id=[chunkhash]',
        }
    });


if (mix.inProduction()) {
    mix.version();
}
