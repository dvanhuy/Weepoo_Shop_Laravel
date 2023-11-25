<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details Page</title>
    <link rel="stylesheet" href="{{ asset('css/get_list_cart.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    @include('header')
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
        <a href="">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Chi tiết sản phẩm</span> 
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
        @foreach($carts as $cart)
        <div class="item_figure box_gird" id="{{ $cart->cart_id }}">
            <div class="info_item">
                <input type="checkbox" name="" id="">
                <div class="img_item">
                    <img src="{{ $cart->hinh_anh }}" >
                </div>
                <div class="name_item">{{ $cart->ten }}</div>
            </div>
            <div>{{ number_format($cart->gia, 0, ',', '.') }} VNĐ</div>
            <div>{{ $cart->so_luong }}</div>
            <div>{{ number_format($cart->gia*$cart->so_luong, 0, ',', '.') }} VNĐ</div>
            <div class="button_delete" onclick="removeCart('{{ $cart->cart_id }}')">Xóa</div>
        </div> 
        @endforeach
    </main> 
    <div class="footer_fixed">
        <div>
            Tổng tiền : 123123123 VNĐ
        </div>
        <button>Mua hàng</button>
    </div>

    <script>
        function removeCart(cart_id){
            console.log(cart_id);
            $.ajax({
                url: "{{ route('cart.delete', '') }}/" + cart_id,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function (data) {
                    if (data.success) {
                        // Xử lý thành công
                        console.log(data.message);
                        const element = document.getElementById(cart_id);
                        if (element) {
                            element.remove();
                        }
                    } else {
                        // Xử lý thất bại
                        alert(data.message);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        }
    </script>
</body>
</html>