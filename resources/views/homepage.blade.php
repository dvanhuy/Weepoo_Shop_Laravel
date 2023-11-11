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
        <h2>homepage</h2>
        <div class="header" style="display: flex; gap: 20px;">
            <a href="{{ route('logout') }}">Đăng xuất</a>
        </div>
        <br>
        <div>Tên của bạn là : {{$name}}</div>
        <div>banner</div>
        <div>demo</div>
        <a href="{{ route('figures.index') }}">Xem danh sách đầy đủ</a>
    </body>
</html>
