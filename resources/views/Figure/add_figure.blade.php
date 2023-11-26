<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới mô hình</title>
    <link rel="stylesheet" href="{{ asset('css/add_figure.css')}}">
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
        <a href="{{ route('manage.get_figures_form')}}">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Quản lý mô hình</span> 
            </div>
        </a>
        <a href="">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Thêm mô hình</span> 
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
                <label for="ten">Tên mô hình (*) :
                    <input type="text" name="ten" id="ten">
                </label>
                @error('ten')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="nha_sx">Nhà sản xuất :
                    <input type="text" name="nha_sx" id="nha_sx">
                </label>
                @error('nha_sx')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="numberinfo">
                    <label for="so_luong_da_ban">Đã bán : 
                        <input type="text" name="so_luong_da_ban" id="so_luong_da_ban" value="0">
                    </label>
                    <label for="so_luong_hien_con">Hiện còn (*) : 
                        <input type="text" name="so_luong_hien_con" id="so_luong_hien_con">
                    </label>
                </div>
                @error('so_luong_da_ban')
                    <div class="error">{{ $message }}</div>
                @enderror
                @error('so_luong_hien_con')
                    <div class="error">{{ $message }}</div>
                @enderror
                <label for="gia">Giá (*) :
                        <input type="text" name="gia" id="gia">
                    VNĐ
                </label>
                @error('gia')
                    <div class="error">{{ $message }}</div>
                @enderror
                <div class="size">
                    <div class="size-title">Kích thước :</div>
                    <label for="chieu_cao">Cao : 
                        <input type="text" name="chieu_cao" id="chieu_cao">cm
                    </label>
                    @error('chieu_cao')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    <div class="area">
                        <label for="chieu_dai">Dài : 
                            <input type="text" name="chieu_dai" id="chieu_dai">cm
                        </label>
                        <label for="chieu_rong">× Rộng : 
                            <input type="text" name="chieu_rong" id="chieu_rong">cm
                        </label>
                    </div>
                    @error('chieu_dai')
                    <div class="error">{{ $message }}</div>
                    @enderror
                    @error('chieu_rong')
                    <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <label for="chat_lieu">Chất liệu:
                    <select name="chat_lieu" id="chat_lieu">
                        <option value="Chưa xác định" selected>Chưa xác định</option>
                        <option value="Nhựa PVC">Nhựa PVC</option>
                        <option value="Nhựa ABS">Nhựa ABS</option>
                        <option value="Nhựa Vinly">Nhựa Vinly</option>
                        <option value="Nhựa Poly">Nhựa Poly</option>
                        <option value="Gốm">Gốm</option>
                        <option value="Gỗ">Gỗ</option>
                        <option value="Kim loại">Kim loại</option>
                        <option value="Khác">Khác</option>
                    </select>
                </label>
                <label for="mo_ta">Mô tả : 
                </label>
                <textarea spellcheck="false" type="" name="mo_ta" id="mo_ta"></textarea>
                @error('mo_ta')
                    <div class="error">{{ $message }}</div>
                @enderror
                <button class="buttonAdd">Thêm</button>
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