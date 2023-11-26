<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin người đung</title>
    <link rel="stylesheet" href="{{ asset('css/edit_profile.css')}}">
</head>
<style>
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
<body>
    @include('header')
    <div class="header_main">
        <a href="{{ route('get_home_page') }}">
            <div class="header_name_title">
                <i class="fa-solid fa-house"></i>
                <span>Trang chủ</span>
            </div>
        </a>
        <a href="{{ route('manage.get_users_form') }}">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Quản lý người dùng</span> 
            </div>
        </a>
        <a href="">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Cập nhật thông tin</span> 
            </div>
        </a>

    </div>
    
    <form action="{{ route('manage.update_user',$user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex-box">
            <div class="left">
                @if(Session::has('status'))
                    <div class="status">{{ session('status') }}</div>
                @endif
                <div class="big-img">
                    @if (str_contains($user->avatar, 'http'))
                        <img id="figure_img" src="{{ $user->avatar }}">
                    @else
                        <img id="figure_img" src="{{ asset($user->avatar) }}" >
                    @endif
                </div>
                <label for="avatar">Tệp ảnh của bạn
                    <input type="file" name="avatar" accept="image/png, image/gif, image/jpeg" onchange="loadFile(event)" />
                </label>
                @error('avatar')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="right">
                <label for="name">Tên tài khoản (*) :
                    <input type="text" name="name" id="name" value="{{ $user->name }}">
                </label>
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="email">Email (*) :
                    <input type="text" name="email" id="email" disabled value="{{ $user->email }}">
                </label>
                @if (isset($user->email_verified_at))
                <div class="container_verify">
                    <label for="">Email đã xác thực vào {{$user->email_verified_at}}</label>
                </div>
                @else
                <div class="container_verify">
                    <label for="">Email chưa được xác thực</label>
                </div>
                @endif

                <label for="phone">Số điện thoại : 
                    <input type="text" name="phone" id="phone" value="{{ $user->phone }}">
                </label>
                @error('phone')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="role">Vai trò:
                    <select name="role" id="role" style="font-size: 17px; padding: 5px;">
                        <option value="" selected>Không</option>
                        <option value="admin">Admin</option>
                    </select>
                </label>
                <script>
                    document.getElementById("role").value = "{{ $user->role }}"
                </script>
                <button class="buttonupdate">Cập nhật thông tin</button>
            </div>
        </div>
    </form>
</body>
<script>
    function loadFile(event){
        const output = document.getElementById('figure_img');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
</script>
</html>
