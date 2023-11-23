const mix = require('laravel-mix')

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css');

mix.styles([
    'resources/css/header.css',
],"public/css/header.css");

mix.styles([
    'resources/css/header.css',
],"public/css/header.css");

mix.styles([
    'resources/css/Figure/get_list_figure.css',
],"public/css/get_list_figure.css");
mix.styles([
    'resources/css/Figure/get_detail_figure.css',
],"public/css/get_detail_figure.css");
mix.styles([
    'resources/css/Cart/get_list_cart.css',
],"public/css/get_list_cart.css");

mix.styles([
    'resources/css/Admin/manageUsers.css',
],"public/css/manageUsers.css");
