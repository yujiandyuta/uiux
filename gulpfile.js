const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');
// require('laravel-elixir-vueify');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

// mix.sassはresources/assets/sass内のファイルを参照して、
// public/css/にコンパイルしたファイルを格納する。
// mix.webpackはresources/assets/js内のファイルを参照して、
// public/js/にコンパイルしたファイルを格納する。
// メソッドチェーンで記載可能。
elixir(mix => {
    mix.sass('app.scss')
        .sass('mystyles.scss')
        .webpack('app.js')
        .webpack('myscripts.js');
});

// 「バージョニング」で検索。
// CSSやJavaScriptファイルを更新しても、ファイル名が同じ場合、
// ブラウザがそれらををキャッシュしたままで、更新が反映されない問題を解決する。
elixir(function(mix) {
    mix.version(['css/app.css', 'css/mystyles.css', 'js/app.js', 'js/myscripts.js']);
});
