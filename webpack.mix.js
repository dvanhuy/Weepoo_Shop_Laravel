const mix = require('laravel-mix')

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css');

mix.styles([
    'resources/css/Auth/login.css',
],"public/css/auth.css");