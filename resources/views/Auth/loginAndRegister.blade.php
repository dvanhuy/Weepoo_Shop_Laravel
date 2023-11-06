<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css')}}">
    <title>Weepoo Shop Login</title>
</head>
<style>
    .error{
        color: red;
        font-size: 11px;
    }
</style>

<body>
<!-- {{ request()->is('register') ? 'active' : '' }} -->
<!-- {{ Route::currentRouteName() == 'get_form_register' ? 'active' : ''  }} -->
    <div class="container {{ Route::currentRouteName() == 'get_form_register' ? 'active' : ''  }}" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h1>Tạo tài khoản</h1>
                <!-- <div class="social-icons">
                    <a href="{{ route('login_with_google') }}" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="{{ route('login_with_facebook') }}" class="icon"><i class="fa-brands fa-facebook-f"></i></a>   
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div> -->
                <span style="padding-top: 20px;">Sử dụng email của bạn để đăng ký</span>
                <input type="text" name="namereg" placeholder="Tên người dùng">
                @error('namereg')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="email" name="emailreg" placeholder="Email">
                @error('emailreg')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="passwordreg" placeholder="Mật khẩu">
                @error('passwordreg')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button>Đăng kí</button>
                @if(Session::has('fail'))
                    <div class="error" style="margin-top: 10px; font-size: 13px;">{{ session::get('failreg') }}</div>
                @endif
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1>Đăng nhập</h1>
                <div class="social-icons">
                    <a href="{{ route('login_with_google') }}" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="{{ route('login_with_facebook') }}" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <!-- <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a> -->
                </div>
                <span>hoặc đăng nhập tài khoản của bạn ở dưới</span>
                <input type="text" name="email" placeholder="Email" value="{{ session::get('emailfill') }}">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="password" placeholder="Mật khẩu">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <a href="#">Quên mật khẩu?</a>
                <button>Đăng nhập</button>
                @if(Session::has('fail'))
                    <div class="error" style="margin-top: 10px; font-size: 13px;">{{ session::get('fail') }}</div>
                @endif
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Nhập thông tin của bạn để sử dụng tất cả các tính năng của trang web</p>
                    <button class="hidden" id="login">Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chào bạn!</h1>
                    <p>Đăng ký với thông tin cá nhân của bạn để sử dụng tất cả các tính năng của trang web</p>
                    <button class="hidden" id="register">Đăng kí</button>
                </div>
            </div>
        </div>
    </div>

    <script>
      const container = document.getElementById('container');
      const registerBtn = document.getElementById('register');
      const loginBtn = document.getElementById('login');

      registerBtn.addEventListener('click', () => {
          container.classList.add("active");
      });

      loginBtn.addEventListener('click', () => {
          container.classList.remove("active");
      });
    </script>
</body>

</html>