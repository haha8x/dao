let mix = require('laravel-mix');

mix.options({
    processCssUrls: false
});

const resourcePath = 'platform/packages/dao';
const publicPath = 'public/vendor/packages/dao';

mix
    .js(resourcePath + '/resources/assets/js/validate.js', publicPath + '/js')
    .copy(publicPath + '/js/validate.js', resourcePath + '/public/js');
