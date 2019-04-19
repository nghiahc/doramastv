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

mix.setPublicPath('public');

mix.sass('resources/sass/frontend/app.scss', 'css/frontend.css')
    .sass('resources/sass/backend/app.scss', 'css/backend.css')
    .js('resources/js/frontend/app.js', 'js/frontend.js')
    .js('resources/js/frontend/plugins/jwplayer-8.6.2/jwplayer.js', 'js/jwplayer-8.6.2/jwplayer.js')
    .js('resources/js/frontend/plugins/jwplayer-8.6.2/jwplayer.core.controls.html5.js', 'js/jwplayer-8.6.2/jwplayer.core.controls.html5.js')
    .js('resources/js/frontend/plugins/jwplayer-8.6.2/jwplayer.core.controls.polyfills.html5.js', 'js/jwplayer-8.6.2/jwplayer.core.controls.polyfills.html5.js')
    .js('resources/js/frontend/plugins/jwplayer-8.6.2/related.js', 'js/jwplayer-8.6.2/related.js')
    .js('resources/js/frontend/plugins/jwplayer-8.6.2/provider.cast.js', 'js/jwplayer-8.6.2/provider.cast.js')
    .js('resources/js/frontend/plugins/jwplayer-8.6.2/provider.airplay.js', 'js/jwplayer-8.6.2/provider.airplay.js')
    .js([
        'resources/js/backend/before.js',
        'resources/js/backend/app.js',
        'resources/js/backend/after.js'
    ], 'js/backend.js')

    .extract([
        'jquery',
        'bootstrap',
        'popper.js/dist/umd/popper',
        'axios',
        'sweetalert2',
        'lodash'
    ]).autoload({
    jquery: ['$', 'window.jQuery', 'jQuery']
});

if (mix.inProduction() || process.env.npm_lifecycle_event !== 'hot') {
    mix.version();
}
