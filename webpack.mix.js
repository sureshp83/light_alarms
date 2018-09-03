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

mix.sass('resources/assets/sass/app.scss', 'public/css')
    .copy('resources/assets/img', 'public/img')
    .options({
      processCssUrls: false
    })
    .js('resources/assets/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            modules: [
                'node_modules'
            ],
            alias: {
                'vue$': 'vue/dist/vue.js'
            }
        }
   });


mix.browserSync({
    host:     '192.168.1.20',
    proxy:    'lightalarms.zorg',
    open:     false,
    ui:       false,
    codeSync: false,
    files:    [
        'app/**/*',
        'public/**/*',
        'resources/views/**/*',
    ],
    notify: {
        styles: {
            top:                    'auto',
            bottom:                 '0',
            margin:                 'auto',
            padding:                '10px',
            borderBottomLeftRadius: "0",
            color:                  "#000",
            backgroundColor:        "#c55"
        }
    }
});
