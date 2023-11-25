<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý mô hình</title>
    <link rel="stylesheet" href="{{ asset('css/manage_page.css')}}">
</head>
<body>
    @include('header')
    <h1 class="page_title">Quản lý mô hình</h1>
    <div class="header_name_search">
        <label for="order">Sắp xếp theo : </label>
        <select name="order" id="order">
            <option value="">Giá tăng dần</option>
            <option value="">Giá giảm dần</option>
            <option value="">Mới cập nhật</option>
            <option value="">Cũ nhất</option>
        </select>
        <label for="search_column" style="margin-left: 30px;">Cột tìm kiếm : </label>
        <select name="columnsearch" id="columnsearch">
            <option value="">id</option>
            <option value="">tên</option>
            <option value="">123123s</option>
            <option value="">123t</option>
        </select>
        <label for="search" id="search_input_lable">Tìm kiếm </label>
        <input type="text" name="" id="search_input" placeholder="Thiết bị cần tìm kiếm">
        <button id="button_search"><i class="fa-solid fa-magnifying-glass"></i></button>
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
                            <a href="" class="delete">Xóa</a>
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
    <div class="footer_main">
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
    </div>
</body>
</html>