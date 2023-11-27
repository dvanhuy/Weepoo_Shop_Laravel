<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="{{ asset('css/get_list_cart.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<style>
    .disable_container{
        pointer-events: none;
        background-color: #FFB9B9;
        opacity: 0.8;
        position: relative;
    }
    .disable_container::before{
        content: "Sản phẩm đã bị xóa";
        position: absolute;
        top: 20px;
        right: 5px;
    }
    .disable_container .button_delete{
        pointer-events: all;
    }
    .so_luong_con{
        position: absolute;
        font-size: 13px;
        bottom: 20px;
    }
    .requireUpdate{
        background-color: rgb(235, 235, 235);
    }
    .requireUpdate input[type='checkbox']{
        pointer-events: none;
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
        <a href="{{ route('figures.index') }}">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Danh sách sản phẩm</span> 
            </div>
        </a>
        <a href="">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Giỏ hàng</span> 
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
        <div class="item_figure box_gird {{ $cart->deleted_at ? 'disable_container' : ''  }} {{ $cart->so_luong_hien_con < $cart->so_luong ? 'requireUpdate' : '' }}" id="{{ $cart->cart_id }}">
            <a style="color: black; text-decoration: none;" href="{{ route('figures.showdetail',$cart->id_figure) }}">
                <div class="info_item">
                    <input type="checkbox" value="{{ $cart->cart_id }}" data-price="{{$cart->gia*$cart->so_luong}}" onchange="calcprice(event)">
                    <div class="img_item">
                        <img src="{{ $cart->hinh_anh }}" >
                    </div>
                    <div class="name_item">{{ $cart->ten }}</div>
                </div>
            </a>
            <div >{{ number_format($cart->gia, 0, ',', '.') }} VNĐ</div>
            <div class="number">
                <div class="buttonupdate" onclick="changeNumberCart('{{ $cart->cart_id }}',-1)">-</div>
                <div id="so_luong_{{ $cart->cart_id }}">{{ $cart->so_luong }}</div>
                <div class="buttonupdate" onclick="changeNumberCart('{{ $cart->cart_id }}',1)">+</div>
                <span class="so_luong_con">Còn {{ $cart->so_luong_hien_con }} sản phẩm</span>
            </div>
            <div class="price" >{{ number_format($cart->gia*$cart->so_luong, 0, ',', '.') }} VNĐ</div>
            <div class="button_delete" onclick="removeCart('{{ $cart->cart_id }}')">Xóa</div>
        </div> 
        @endforeach
    </main> 
    <div class="footer_fixed">
        <div class="totalprice">
        0 VNĐ
        </div>
        <button onclick="pay()">Mua hàng</button>
    </div>

    <script>
        let totalmoney = 0;
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
                            calcTotalPrice()
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

        function calcprice(e){
            if (e.target.checked){
                totalmoney += parseInt(e.target.dataset.price);
            } else {
                totalmoney -= parseInt(e.target.dataset.price);
            }
            formatTotalPrice();
        }

        function formatTotalPrice(){
            const total_price_element = document.getElementsByClassName("totalprice")[0]
            const formatter = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND',
            });
            const formattedNumber = formatter.format(totalmoney);
            total_price_element.innerHTML = formattedNumber.slice(0,-2)+" VNĐ";
        }
        function pay(){
            const choose_carts = document.querySelectorAll(".info_item input[type='checkbox']")
            const newUrl = new URL("{{ route('cart.get_form_pay') }}")
            let cartIDs = []
            let rediectToPay = false;
            for (const choose_cart of choose_carts) {
                if (choose_cart.checked) {
                    cartIDs.push(choose_cart.value)
                    rediectToPay=true
                }
            }
            if (rediectToPay) {
                newUrl.searchParams.set("cartIDs",cartIDs.join(','));
                window.location.href=newUrl.href
            }
            else{
                alert("Chưa chọn mô hình")
            }
        }

        function changeNumberCart(cart_id,number){
            const updateElement = document.getElementById("so_luong_"+cart_id)
            $.ajax({
                url: "{{ route('cart.update') }}",
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "cartID" : cart_id,
                    "updateNumber" : number,
                },
                dataType: "json",
                success: function (data) {
                    if (data.success){
                        updateElement.innerHTML = parseInt(updateElement.innerHTML) + parseInt(number)
                        console.log(data);
                    }
                    else{
                        updateElement.innerHTML = data.so_luong_con
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