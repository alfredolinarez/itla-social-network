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

mix.copy("resources/images/**", "public/images");
mix.styles(["resources/css/estilo.css"], "public/css/estilo.css");
mix.browserSync("127.0.0.1:8000");
