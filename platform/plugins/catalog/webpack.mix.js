let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/plugins/catalog';
const resourcePath = './platform/plugins/catalog';

mix
    .js(resourcePath + '/resources/assets/js/catalog.js', publicPath + '/js')
    .copy(publicPath + '/js/catalog.js', resourcePath + '/public/js');