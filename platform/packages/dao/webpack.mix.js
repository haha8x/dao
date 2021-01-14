let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/packages/dao';
const resourcePath = './platform/packages/dao';

mix
    .js(resourcePath + '/resources/assets/js/request-transfer.js', publicPath + '/js')
    .copy(publicPath + '/js/request-transfer.js', resourcePath + '/public/js')
    .sass(resourcePath + '/resources/assets/sass/dao.scss', publicPath + '/css')
    .copy(publicPath + '/css/dao.css', resourcePath + '/public/css');