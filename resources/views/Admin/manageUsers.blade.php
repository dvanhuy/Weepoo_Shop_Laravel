<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="{{ asset('css/manage_page.css')}}">
</head>
<body>
    @include('header')
    <h1 class="page_title">Quản lý người dùng</h1>
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
    </div>
    <main>
        <div class="container_table">
            <table>
                <tr>
                    <th>Id</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Email xác thực</th>
                    <th>Tạo lúc</th>
                    <th>Cập nhật lúc</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th>id Mạng xã hội</th>
                    <th>Mạng xã hội</th>
                    <th>Xóa lúc</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->social_id }}</td>
                    <td>{{ $user->social_type }}</td>
                    <td>{{ $user->deleted_at }}</td>
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