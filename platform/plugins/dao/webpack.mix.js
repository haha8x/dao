let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/dao';
const resourcePath = './platform/plugins/dao';

mix
    .js(resourcePath + '/resources/assets/js/dao.js', publicPath + '/js')
    .copy(publicPath + '/js/dao.js', resourcePath + '/public/js')
    .sass(resourcePath + '/resources/assets/sass/dao.scss', publicPath + '/css')
    .copy(publicPath + '/css/dao.css', resourcePath + '/public/css');