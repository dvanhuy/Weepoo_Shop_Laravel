<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weepoo Shop</title>
    
</head>

<body>
    @include('header')
    <form action="">
        <div class="search_box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Tìm kiếm trên Weepoo shop">
            <input type="submit" value="Tìm kiếm">
        </div>
    </form>
    <h2>homepage</h2>
    <a href="{{ route('figures.index') }}">Xem danh sách đầy đủ</a>
</body>
<style>
    body {
        font-family: 'Nunito', sans-serif;
    }
    .search_box{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50%;
        margin: auto;
        background-color: rgb(244, 244, 244);
        border-radius: 30px;
        padding-left: 20px;
        overflow: hidden;
    }

    .search_box input[type=text]{
        width: 100%;
        height: 35px;
        min-width: 300px;
        outline: none;
        box-sizing: border-box;
        border: none;
        font-size: 20px;
        padding: 10px 20px;
        background-color: transparent;
        font-family: 'Varela Round', sans-serif;
    }
    .search_box input[type=submit]{
        height: 100%;
        width: 100px;
        background-color: transparent;
        border: none;
        padding: 15px 10px;
        font-family: 'Varela Round', sans-serif;
        border-left: 1px solid rgb(168, 168, 168);
        font-size: 15px;
    }

    .search_box input[type=submit]:hover{
        background-color: rgb(86, 179, 229);
        color: white;
    }
</style>
</html>