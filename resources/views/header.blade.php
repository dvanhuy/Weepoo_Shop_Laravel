<link rel="stylesheet" href="{{ asset('css/header.css')}}">
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
            <div class="avatar" onclick="tooglemenu()">
                <img src="{{ asset('images/avatardefault.png') }}">
            </div>
            <div class="menuuser hidemenu">
                <ul>
                    @if (Auth::check())
                        <div>Tên : {{ Auth::user()->name }}</div>
                        <a href=""><li>Cập nhật thông tin</li></a>
                        <a href=" {{ route('logout') }}"><li>Đăng Xuất</li></a>
                    @else
                        <a href=" {{ route('get_form_login') }} "><li>Đăng nhập</li></a>
                        <a href=" {{ route('get_form_register') }} "><li>Đăng kí</li></a>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</head>
<script>
    const menuuser = document.querySelector(".menuuser")
    function tooglemenu(){
        menuuser.classList.toggle("hidemenu"); 
    }
</script>