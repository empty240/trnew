const mix = require("laravel-mix");

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

mix.js("resources/js/tr/app.js", "public/js/app-tr.js")
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();

mix.copy(
    "node_modules/medium-editor/dist/css/medium-editor.css",
    "public/css/medium-editor.css"
);
mix.copy(
    "node_modules/medium-editor/dist/css/themes/default.css",
    "public/css/medium-editor-default-theme.css"
);
