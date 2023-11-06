<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Weepoo Shop</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="header" style="display: flex; gap: 20px;">
            <a href="{{ route('get_form_login') }}">Đăng nhập</a>
            <a href="{{ route('get_form_register') }}">Đăng kí</a>
            <div>admin@gmail.com</div>
            <div>12345</div>
        </div>
    </body>
</html>
