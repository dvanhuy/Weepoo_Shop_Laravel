<link rel="stylesheet" href="{{ asset('css/header.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<header>
    <nav>
        <a href="{{ route('get_home_page') }}" style="text-decoration: none; color: black;"><div class="logo">Weepoo Shop</div></a>
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
                        @if (Auth::user()->isAdmin())
                            <a href="{{ route('manage.get_users_form') }}"><li>Quản lý người dùng</li></a>
                            <a href="{{ route('manage.get_figures_form') }}"><li>Quản lý mô hình</li></a>
                        @endif
                        <a href=" {{ route('users.get_form_editprofile') }} "><li>Cập nhật thông tin</li></a>
                        <a href=" {{ route('bill.index') }} "><li>Lịch sử mua</li></a>
                        <a href=" {{ route('users.get_form_changepassword') }} "><li>Đổi mật khẩu</li></a>
                        <a href=" {{ route('logout') }}"><li>Đăng Xuất</li></a>
                    @else
                        <a href=" {{ route('get_form_login') }} "><li>Đăng nhập</li></a>
                        <a href=" {{ route('get_form_register') }} "><li>Đăng kí</li></a>
                    @endif
                </ul>
            </div>
        </div>  
    </nav>
</header>
<script>
    const menuuser = document.querySelector(".menuuser")
    function tooglemenu(){
        menuuser.classList.toggle("hidemenu"); 
    }
</script>