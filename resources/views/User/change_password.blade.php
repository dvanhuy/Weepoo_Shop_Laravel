<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
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
        <a href="">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Đổi mật khẩu</span> 
            </div>
        </a>
    </div>
    <main>
        <form action="{{ route('users.change_password',$user->id) }}" method="post">
            @csrf
            <div class="container">
                <label for="password">Mật khẩu cũ :
                    <input type="password" name="password" id="password">
                </label>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="oldpassword">Mật khẩu mới :
                    <input type="password" name="newpassword" id="newpassword">
                </label>
                @error('newpassword')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="confirmpassword">Xác nhận mật khẩu :
                    <input type="password" name="confirmpassword" id="confirmpassword">
                </label>
                @error('confirmpassword')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button class="buttonconfirm">Xác nhận</button>
                @if(Session::has('status'))
                    <div class="status">{{ session('status') }}</div>
                @endif
            </div>
        </form>
    </main>
</body>
<style>
.container{
    display: flex;
    flex-direction: column;
    gap: 20px;
    width: 500px;
    margin: 30px auto;
}
.container input[type='password']{
    margin-top: 5px;
    padding: 10px 20px;
    box-sizing: border-box;
    width: 100%;
    font-size: 20px;
}
.container label{
    font-size: 20px;
}
.buttonconfirm{
    background-color: #73D691;
    height: 40px;
    margin-top: 20px;
    font-size: 20px;
}
.error{
        color: red;
        font-size: 11px;
}
.status{
    color: red;
    margin-bottom: 10px;
    font-size: 20px;
}

</style>
</html>