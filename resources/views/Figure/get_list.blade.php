<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/get_list_figure.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <header>
        <div class="logo">
            Weepoo
        </div>
        <div class="user_avatar">Avatar</div>
    </header>
    <form action="">
        <div class="search_box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Tìm kiếm trên Weepoo shop">
            <input type="submit" value="Tìm kiếm">
        </div>
    </form>
    <main>
        <div class="header_main">
            <a href="">
                <div class="header_name_title">
                    <i class="fa-solid fa-house"></i>
                    <span>Trang chủ</span> 
                </div>
            </a>
            <a href="">
                <div class="header_name_titlesub">
                    <i class="fa-solid fa-house"></i>
                    <span>Danh sách sản phẩm</span> 
                </div>
            </a>
            
            <div class="header_name_search">
                <label for="order">Sắp xếp theo : </label>
                <select name="order" id="order">
                    <option value="">Giá tăng dần</option>
                    <option value="">Giá giảm dần</option>
                    <option value="">Mới cập nhật</option>
                    <option value="">Cũ nhất</option>
                </select>
                <label for="search" id="search_input_lable">Tìm kiếm </label>
                <input type="text" name="" id="search_input" placeholder="Thiết bị cần tìm kiếm">
                <button id="button_search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="container_main">
            @foreach($figures as $figure)
            <a class="container_main_item" href="{{ route('figures.showdetail',$figure->id) }}">
                <div class="item_image">
                    <img src="{{$figure->hinh_anh}}">
                </div>
                <div class="item_name">
                    {{$figure->ten}}
                </div>
                <div class="item_price">
                    {{ number_format($figure->gia, 0, ',', '.') }} VNĐ
                </div>
                <div class="item_subprice">
                    {{$figure->created_at}}
                </div>
            </a>
            @endforeach
        </div>
        <div class="footer_main">
            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a class="active" href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
                </div>
        </div>
    </main>
</body>
</html>