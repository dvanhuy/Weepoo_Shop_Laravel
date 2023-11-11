<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details Page</title>
    <link rel="stylesheet" href="{{ asset('css/get_detail_figure.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <head>
        <nav>
            <div class="logo">Weepoo Shop</div>
            <div class="nav_container">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Offers</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <a href="{{ route('cart.index') }}" class="cart"><i class="fas fa-shopping-cart"></i></a>
                </ul>
                <div class="avatar">
                    <img src="https://media.istockphoto.com/id/1300845620/vector/user-icon-flat-isolated-on-white-background-user-symbol-vector-illustration.jpg?s=612x612&w=0&k=20&c=yBeyba0hUkh14_jgv1OKqIH0CCSWU_4ckRkAoy2p73o=" alt="">
                </div>
            </div>
           
        </nav>
    </head>

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

    <div class="flex-box">
        <div class="left">
            <div class="big-img">
                <img src="{{ $figure->hinh_anh }}">
            </div>
        </div>

        <div class="right">
            <div class="name">{{ $figure->ten }}</div>
            <div class="producer">{{ $figure->nha_sx }}</div>
            <div class="numberinfo">
                <div>Đã bán : {{ $figure->so_luong_da_ban }}</div>
                <div>Hiện còn : {{ $figure->so_luong_hien_con }}</div>
            </div>
            <div class="price">{{ number_format($figure->gia, 0, ',', '.') }} VNĐ</div>
            <div class="size">
                <div class="size-title">Kích thước :</div>
                <div class="height">
                    Cao : {{ $figure->chieu_cao }}
                </div>
                <div class="area">
                    Dài × Rộng : {{ $figure->chieu_dai }} × {{ $figure->chieu_rong }}
                </div>
            </div>
            <div class="description">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt possimus nihil accusamus tempora harum. Repellendus, culpa dolor neque dicta quos, iusto est ipsam impedit soluta porro, nam possimus unde explicabo.
                e dicta quos, iusto est ipsam impedit soluta porro, nam possi
            </div>
            <div class="add_to_card">
                <div class="numberproduct">
                    <div class="minusnumber" onclick="minus()">-</div>
                    <input type="text" value="1" class="numberinput">
                    <div class="addnumber" onclick="add()">+</div>
                </div>
                <button class="cart-btn" onclick="addcart()">Add to Cart</button>
            </div>
        </div>
    </div>


    <script>
        const numberproduct = document.querySelector('.numberinput');
        function minus(){
            numberproduct.value = parseInt(numberproduct.value) - 1;
            if(parseInt(numberproduct.value=0)){
                numberproduct.value = 1
            }
        }
        function add(){
            numberproduct.value = parseInt(numberproduct.value) + 1;
        }
        function addcart(){
            if ("{{ Auth::check() }}"){
                const id_user="{{ Auth::id() }}"
                const id_figure ="{{ $figure->id }}"
                const so_luong=document.querySelector('.numberinput').value
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_user": id_user,
                        "id_figure": id_figure,
                        "so_luong": so_luong,
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.success) {
                            // Xử lý thành công
                            alert(data.message);
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
            else{
                window.location.href = "{{ route('get_form_login') }}";
            }
        }
    </script>
</body>
</html>