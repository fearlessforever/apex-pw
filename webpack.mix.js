let mix = require('laravel-mix');
let tailwindcss = require('tailwindcss')

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

mix.sass('resources/assets/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('tailwind.js')]
    })

/* mix.postCss('resources/assets/css/app.css', 'public/css', [tailwindcss('tailwind.js')])
   .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/assets/js/'),
            },
        },
    });
 */

if (mix.inProduction()) {
    mix.version()
}