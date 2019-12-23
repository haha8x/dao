let mix = require('laravel-mix');

const resourcePath = 'platform/themes/main/assets';
const publicPath = 'public/storage/assets';

mix
    .sass(resourcePath + '/admin/default.scss', 'public/vendor/core/css/themes/default.css')
    .sass(resourcePath + '/admin/white.scss', 'public/vendor/core/css/themes/white.css')
    // .copy(publicPath + '/css/style.css', resourcePath + '/css/style.css')
    // .styles([
    //     resourcePath + '/css/adminlte.min.css',
    //     'vendor/core/plugins/language/css/language-public.css'
    // ], publicPath + '/css/main.css')
    // .scripts([
    //     resourcePath + '/plugins/jquery/jquery.min.js',
    //     resourcePath + '/plugins/bootstrap/js/bootstrap.bundle.min.js',
    //     resourcePath + '/plugins/moment/moment.min.js',
    //     resourcePath + '/plugins/daterangepicker/daterangepicker.js',
    //     resourcePath + '/plugins/chart.js/Chart.min.js',
    //     resourcePath + '/custom.js',
    //     'vendor/core/plugins/language/js/language-public.js'
    // ], publicPath + '/js/main.js')
    .options({
        processCssUrls: false,
        uglify: {
            parallel: 8, // Use multithreading for the processing
            uglifyOptions: {
                mangle: true,
                compress: true, // The slow bit
            }
        }
    });
