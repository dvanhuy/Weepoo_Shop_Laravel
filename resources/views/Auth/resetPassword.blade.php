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
    <div class="container" id="container" style="display: flex;justify-content: center;">
        <div class="form-container">
            <form action="{{ route('reset_password') }}" method="post">
                @method('PUT')
                @csrf
                <h1 style="margin-bottom: 20px;">Đặt lại mật khẩu</h1>
                <span >Nhập email của bạn để lấy lại mật khẩu</span>
                <input type="text" name="email" placeholder="Email" value="{{ $emailfill }}">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="newpassword" placeholder="Mật khẩu mới">
                @error('newpassword')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="confirmpassword" placeholder="Xác nhận mật khẩu">
                @error('confirmpassword')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button>Xác nhận</button>
                @if(Session::has('status'))
                    <div class="error" style="margin-top: 10px; font-size: 13px;">{{ session('status') }}</div>
                @endif
                <input type="hidden" name="tokenreset" value="{{ $token }}">
                <a href="{{ route('get_form_login') }}">Trờ về đăng nhập</a>
            </form>
        </div>
    </div>
    
</body>
</html>