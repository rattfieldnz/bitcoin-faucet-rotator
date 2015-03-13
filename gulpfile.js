/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
var elixir = require('laravel-elixir');
var gulp = require('gulp'), 
sass = require('gulp-ruby-sass') 
notify = require("gulp-notify") 
bower = require('gulp-bower');

var paths = {
    'bootstrap': 'public/bower_components/bootstrap-sass-official/assets/',
    'fontawesome': 'public/bower_components/fontawesome/',
    'tablesorter' : 'public/table_sorter_themes/'
}

elixir(function(mix) {
    mix.sass('app.scss', 'public/css/', {includePaths:
        [paths.bootstrap + 'stylesheets/',
         paths.fontawesome + 'scss/']});

    mix.styles([
        paths.fontawesome + "css/font-awesome.css",
        paths.tablesorter + "blue/style.css",
        "app.css"
        /* run gulp --production to minify css file. */
    ], 'public/css/master-final.min.css', 'public/css');

    mix.copy('public/bower_components/fontawesome/fonts/*', 'public/fonts');

});