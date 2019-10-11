const mix = require('laravel-mix');

mix.sass('resources/sass/app.scss', 'public/css/app.css')
    .options({
        processCssUrls: false,
        postCss: [ require("tailwindcss") ]
    }).js('resources/js/app.js', 'public/js')
    .copy('resources/img','public/img',true);

//Dashboard
mix.js('resources/js/dashboard.js', 'public/js');
mix.sass('resources/sass/layouts/dashboard/app.scss', 'public/css/layouts/dashboard/app.css')
    .options({
        processCssUrls: false,
        postCss: [ require("tailwindcss") ]
    });