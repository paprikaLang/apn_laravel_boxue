const mix = require('laravel-mix');

/**
 * 定义一个数组，包含工程中当前使用的所有js文件
 * 把这些js文件打包成vendor.js，并把它拷贝到public/js目录
 * 所有sass文件，让浏览器加载它们之前，先把它们翻译成普通的css
 * 完成后，把所有的css文件也打包到一起
*/
const jsScripts = [
    'node_modules/vue/dist/vue.js',
    'resources/js/app.js'
];

const cssScripts = [
    'public/css/app.css',
    // 'public/css/colors.css'
];
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

mix.js(jsScripts, 'public/js/vendor.js')
    .sass('resources/sass/app.scss', 'public/css/app.css')
    .styles(cssScripts, 'public/css/vendor.css');

if (mix.inProduction()) {
    mix.version();
}

// mix.copyDirectory('node_modules/material-design-icons/iconfont', 'public/fonts');