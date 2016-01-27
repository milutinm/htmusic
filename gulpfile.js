var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    //mix.scriptsIn("resources/assets/js")
    mix.scripts(['ie10-viewport-bug-workaround.js','moment.js','bootstrap-datetimepicker.js','htmusic.js','bootstrap-list-filter.src.js'])
        .stylesIn("resources/assets/css")
        .sass('app.scss')
        .version(["css/all.css", "css/app.css", "js/all.js"]);
});
