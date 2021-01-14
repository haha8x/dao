let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/packages/hr';
const resourcePath = './platform/packages/hr';

mix
    .js(resourcePath + '/resources/assets/js/hr.js', publicPath + '/js')
    .copy(publicPath + '/js/hr.js', resourcePath + '/public/js')
    .sass(resourcePath + '/resources/assets/sass/hr.scss', publicPath + '/css')
    .copy(publicPath + '/css/hr.css', resourcePath + '/public/css');