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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/appDarkMode.scss', 'public/css');
/**
 * Para compilar los archivos TypeScript
 *
 * --Esta comentado para que no falle el Vue
 */
//mix.ts('resources/ts/modoNocturnoDiurno.ts', 'public/js');
