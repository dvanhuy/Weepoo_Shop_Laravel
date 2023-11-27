<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body style="text-align: center;">
    <h1>Thông tin đã chọn</h1>
    @foreach($carts as $cart)
        <h2>id figure :{{$cart->id_figure}}  => số lượng :{{$cart->so_luong}}</h2>
    @endforeach
    <h1>Cách thanh toán</h1>
    <h2>Chưa hỗ trợ</h2>

    <h1>Xác nhận thanh toán</h1>
    <button style="font-size: 20px; padding: 10px 20px;" onclick="pay()">Thanh toán</button>
    <br>
    <br>
    <a href="{{ route('get_home_page') }}">Trở về</a>
</body>
<script>
    function pay(){
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const cartIDs = urlParams.get('cartIDs')
        $.ajax({
            url: "/cart/pay",
            method: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "cartIDs" : cartIDs,
            },
            dataType: "json",
            success: function (data) {
                alert(data.message)
                window.location.href = "{{ route('get_home_page') }}";
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            }
        });
    }
</script>
</html>