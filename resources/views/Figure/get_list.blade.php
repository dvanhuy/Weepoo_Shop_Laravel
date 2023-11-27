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
    @include('header')
    <main>
        <div class="header_main">
            <a href="{{ route('get_home_page') }}">
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
                    <option value="recently">Mới cập nhật</option>
                    <option value="oldest">Cũ nhất</option>
                    <option value="pricedesc">Giá giảm dần</option>
                    <option value="priceasc">Giá tăng dần</option>
                </select>
                <label for="search_column" style="margin-left: 30px;">Cột tìm kiếm : </label>
                <select name="columnsearch" id="columnsearch">
                    <option value="ten">Tên</option>
                </select>
                <label for="search" id="search_input_lable">Tìm kiếm </label>
                <input type="text" name="" id="search_input" placeholder="Thiết bị cần tìm kiếm">
                <button id="button_search" onclick="search()"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="container_main">
            @foreach($figures as $figure)
            <a class="container_main_item" href="{{ route('figures.showdetail',$figure->id) }}">
                <div class="item_image">
                    @if (str_contains($figure->hinh_anh, 'http'))
                        <img src="{{ $figure->hinh_anh }}" >
                    @else
                        <img src="{{ asset($figure->hinh_anh) }}" >
                    @endif
                </div>
                <div class="item_name">
                    {{$figure->ten}}
                </div>
                <div class="item_price">
                    {{ number_format($figure->gia, 0, ',', '.') }} VNĐ
                </div>
                <div class="item_subprice">
                    {{$figure->updated_at}}
                </div>
            </a>
            @endforeach
        </div>
        {{ $figures->appends(request()->except('page'))->links('vendor.pagination.custom_pagination') }}
    </main>
</body>
<script>
    function errorImg(event){
        event.target.src = "{{ asset('images/emptyFigure.webp')}}"
        console.log("lỗi lấy ảnh");
    }
    function search(){
        const newUrl = new URL(window.location.href)
        const search_column = document.getElementById('columnsearch').value
        const search_column_value = document.getElementById('search_input').value
        const order = document.getElementById('order').value
        newUrl.searchParams.set('order',order);
        if(search_column_value){
            newUrl.searchParams.set('search-column', search_column);
            newUrl.searchParams.set('search-column-value', search_column_value);
        }
        window.location.href=newUrl.href
    }
</script>
</html>