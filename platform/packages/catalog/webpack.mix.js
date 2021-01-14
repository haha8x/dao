let mix = require('laravel-mix');

const publicPath = 'public/vendor/core/packages/catalog';
const resourcePath = './platform/packages/catalog';

mix
    .js(resourcePath + '/resources/assets/js/catalog.js', publicPath + '/js')
    .copy(publicPath + '/js/catalog.js', resourcePath + '/public/js');