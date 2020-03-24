let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/enhanced-user';
const resourcePath = './platform/plugins/enhanced-user';

mix
    .js(resourcePath + '/resources/assets/js/enhanced-user.js', publicPath + '/js')
    .copy(publicPath + '/js/enhanced-user.js', resourcePath + '/public/js')
    .sass(resourcePath + '/resources/assets/sass/enhanced-user.scss', publicPath + '/css')
    .copy(publicPath + '/css/enhanced-user.css', resourcePath + '/public/css');