<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin cá nhân</title>
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
        <a href="">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Chỉnh sửa trang cá nhân</span> 
            </div>
        </a>
    </div>
    
    <form action="{{ route('figures.add_figure') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex-box">
            <div class="left">
                @if(Session::has('status'))
                    <div class="status">{{ session('status') }}</div>
                @endif
                <div class="big-img">
                    <img id="figure_img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Image_of_none.svg/1200px-Image_of_none.svg.png">
                </div>
                <label>Tệp ảnh của bạn
                    <input type="file" name="hinh_anh" accept="image/png, image/gif, image/jpeg" onchange="loadFile(event)" />
                </label>
                @error('hinh_anh')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="right">
                <label for="name">Tên tài khoản (*) :
                    <input type="text" name="name" id="name">
                </label>
                <label for="email">Email (*) :
                    <input type="text" name="email" id="email">
                </label>
                <div>
                    <label for="">Email chưa được xác thực</label>
                    <button class="verifiedbutton">Xác thực</button>
                </div>

                <label for="phone">Số điện thoại :
                    <input type="text" name="phone" id="phone">
                </label>

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