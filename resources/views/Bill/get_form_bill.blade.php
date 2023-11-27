<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mua hàng</title>
    <link rel="stylesheet" href="{{ asset('css/get_list_cart.css')}}">
</head>
<style>
    .detail{
        padding: 20px 20px;
        cursor: pointer;
        user-select: none;
        text-decoration: none;
        color: black;
    }
    .detail:hover{
        background-color: #C6C6C6;
    }
</style>
<body>
    @include('header')
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
                <span>Lịch sử mua</span> 
            </div>
        </a>
    </div>

    <main>
        <div class="header_tab box_gird">
            <div>Hóa đơn</div>
            <div>Thời gian thanh toán</div>
            <div>Trạng thái</div>
            <div>Tổng tiền</div>
            <div>Thao tác</div>
        </div>
        @foreach($bills as $bill)
        <div class="item_figure box_gird" id="{{ $bill->id }}">
            <div class="info_item">
                <div class="img_item">
                    <img src="{{ $bill->hinh_anh }}" >
                </div>
            </div>
            <div> {{ $bill->thoi_gian_thanh_toan }}</div>
            <div> {{ $bill->trang_thai }}</div>
            <div class="price" >{{ number_format($bill->tong_tien, 0, ',', '.') }} VNĐ</div>
            <a class="detail" href="{{ route('bill.detail',$bill->id) }}" >Xem chi tiết</a>
        </div> 
        @endforeach
    </main> 
</body>
</html>