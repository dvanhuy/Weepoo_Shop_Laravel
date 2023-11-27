<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="{{ asset('css/get_list_cart.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    @include('header')
    <div class="header_main">
        <a href="{{ route('get_home_page') }}">
            <div class="header_name_title">
                <i class="fa-solid fa-house"></i>
                <span>Trang chủ</span> 
            </div>
        </a>
        <a href="{{ route('bill.index') }}">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Lịch sử mua</span> 
            </div>
        </a>
        <a href="">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Chi tiết đơn hàng</span> 
            </div>
        </a>
    </div>

    <main>
        <div class="header_tab box_gird">
            <div>Sản phẩm</div>
            <div>Đơn giá</div>
            <div>Số lượng</div>
            <div>Số tiền</div>
            <div>Thao tác</div>
        </div>
        @foreach($details as $detail)
        <div class="item_figure box_gird" id="{{ $detail->billdetail_id }}">
            <a style="color: black; text-decoration: none;" href="{{ route('figures.showdetail',$detail->id_figure) }}">
                <div class="info_item">
                    <div class="img_item">
                        @if (str_contains($detail->hinh_anh, 'http'))
                            <img src="{{ $detail->hinh_anh }}" >
                        @else
                            <img src="{{ asset($detail->hinh_anh) }}" >
                        @endif
                    </div>
                    <div class="name_item">{{ $detail->ten }}</div>
                </div>
            </a>
            <div >{{ number_format($detail->gia, 0, ',', '.') }} VNĐ</div>
            <div class="number">
                <div>{{ $detail->so_luong }}</div>
            </div>
            <div class="price" >{{ number_format($detail->gia*$detail->so_luong, 0, ',', '.') }} VNĐ</div>
            <div>Chi tiết</div>
        </div> 
        @endforeach
    </main> 
</body>
</html>