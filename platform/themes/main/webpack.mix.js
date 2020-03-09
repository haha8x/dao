let mix = require('laravel-mix');

const resourcePath = 'platform/themes/main/assets';

mix
    .sass(resourcePath + '/admin/default.scss', 'public/vendor/core/css/themes/default.css')
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
