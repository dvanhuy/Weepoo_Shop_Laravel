<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý mô hình</title>
    <link rel="stylesheet" href="{{ asset('css/manage_page.css')}}">
</head>
<style>
    .status{
        color: red;
        margin-bottom: 10px;
        font-size: 20px;
        margin-left: 5%;
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
                <span>Quản lý mô hình</span> 
            </div>
        </a>
    </div>
    @if(Session::has('status'))
        <div class="status">{{ session('status') }}</div>
    @endif
    <div class="header_name_search">
        <label for="order">Sắp xếp theo : </label>
        <select name="order" id="order">
            <option value="recently">Mới cập nhất</option>
            <option value="priceasc">Giá tăng dần</option>
            <option value="pricedesc">Giá giảm dần</option>
        </select>
        <label for="search_column" style="margin-left: 30px;">Cột tìm kiếm : </label>
        <select name="columnsearch" id="columnsearch">
            <option value="id">ID</option>
            <option value="ten">Tên</option>
            <option value="gia">Giá</option>
            <option value="so_luong_hien_con">Hiện còn</option>
            <option value="so_luong_da_ban">Đã bán</option>
            <option value="nha_sx">Nhà sản xuất</option>
            <option value="chieu_cao">Cao</option>
            <option value="chieu_rong">Rộng</option>
            <option value="chieu_dai">Dài</option>
            <option value="chat_lieu">Chất liệu</option>
            <option value="mo_ta">Mô tả</option>
            <option value="chat_lieu">Chất liệu</option>
        </select>
        <label for="search" id="search_input_lable">Tìm kiếm </label>
        <input type="text" name="" id="search_input" placeholder="Thiết bị cần tìm kiếm">
        <button id="button_search" onclick="search()"><i class="fa-solid fa-magnifying-glass"></i></button>
        <a href="{{ route('figures.get_form_add') }}"><div class="addfigure">Thêm mô hình</div></a>
    </div>
    <main>
        <div class="container_table">
            <table>
                <tr>
                    <th>Thao Tác</th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Hiện còn</th>
                    <th>Đã bán</th>
                    <th>Nhà sản xuất</th>
                    <th>Cao</th>
                    <th>Rộng</th>
                    <th>Dài</th>
                    <th>Chất liệu</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Tạo lúc</th>
                    <th>Cập nhật lúc</th>
                    <th>Xóa lúc</th>
                </tr>
                @foreach($figures as $figure)
                <tr>
                    <td >
                        <div class="action">
                            <a href="{{ route('figures.get_form_update',$figure->id) }}" class="update">Sửa</a>
                            <a href="{{ route('figures.delete_figure',$figure->id) }}" class="delete" onclick="return confirm('Bạn có chắn muốn xóa không?');">Xóa</a>
                        </div>
                    </td>
                    <td><p>{{ $figure->id }}</p></td>
                    <td><p>{{ $figure->ten }}</p></td>
                    <td><p>{{ $figure->gia }}</p></td>
                    <td><p>{{ $figure->so_luong_hien_con }}</p></td>
                    <td><p>{{ $figure->so_luong_da_ban }}</p></td>
                    <td><p>{{ $figure->nha_sx }}</p></td>
                    <td><p>{{ $figure->chieu_cao }}</p></td>
                    <td><p>{{ $figure->chieu_rong }}</p></td>
                    <td><p>{{ $figure->chieu_dai }}</p></td>
                    <td><p>{{ $figure->chat_lieu }}</p></td>
                    <td><p>{{ $figure->mo_ta }}</p></td>
                    <td><p>{{ $figure->hinh_anh }}</p></td>
                    <td><p>{{ $figure->created_at }}</p></td>
                    <td><p>{{ $figure->updated_at }}</p></td>
                    <td><p>{{ $figure->deleted_at }}</p></td>
                  </tr>
                @endforeach
            </table>
        </div>
    </main>
    <!-- <div class="footer_main">
        <div class="pagination">
            <a href="#">&laquo;</a>
            <a href="#">1</a>
            <a class="active" href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
            <a href="#">&raquo;</a>
        </div>
    </div> -->
    {{ $figures->appends(request()->except('page'))->links('vendor.pagination.custom_pagination') }}
</body>
<script>
    function search(){
        const newUrl = new URL(window.location.href)
        const search_column = document.getElementById('columnsearch').value
        const search_column_value = document.getElementById('search_input').value
        const order = document.getElementById('order').value
        newUrl.searchParams.set('order',order);
        if(search_column_value){
            newUrl.searchParams.set('search-column', search_column);
            newUrl.searchParams.set('search-column-value', search_column_value);
        }
        window.location.href=newUrl.href
    }
</script>
</html>