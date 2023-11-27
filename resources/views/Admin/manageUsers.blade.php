<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
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
        <a href="{{ route('manage.get_users_form') }}">
            <div class="header_name_titlesub">
                <i class="fa-solid fa-house"></i>
                <span>Quản lý người dùng</span> 
            </div>
        </a>
    </div>
    @if(Session::has('status'))
        <div class="status">{{ session('status') }}</div>
    @endif
    <div class="header_name_search">
        <label for="order">Sắp xếp theo : </label>
        <select name="order" id="order">
            <option value="recently">Mới cập nhật</option>
        </select>
        <label for="search_column" style="margin-left: 30px;">Cột tìm kiếm : </label>
        <select name="columnsearch" id="columnsearch">
            <option value="id">ID</option>
            <option value="name">Tên</option>
            <option value="email">Email</option>
            <option value="phone">Số điện thoại</option>
            <option value="role">Vai trò</option>
            <option value="avatar">Ảnh đại diện</option>
        </select>
        <label for="search" id="search_input_lable">Tìm kiếm </label>
        <input type="text" name="" id="search_input" placeholder="Thiết bị cần tìm kiếm">
        <button id="button_search" onclick="search()"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <main>
        <div class="container_table">
            <table>
                <tr>
                    <th>Thao Tác</th>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th>Ảnh đại diện</th>
                    <th>Tạo lúc</th>
                    <th>Cập nhật lúc</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td >
                        <div class="action">
                            <a href="{{ route('manage.get_form_update_user',$user->id) }}" class="update">Sửa</a>
                            <a href="{{ route('manage.delete_user',$user->id) }}" class="delete" onclick="return confirm('Bạn có chắn muốn xóa không?');">Xóa</a>
                        </div>
                    </td>
                    <td><p>{{ $user->id }}</p></td>
                    <td><p>{{ $user->name }}</p></td>
                    <td><p>{{ $user->email }}</p></td>
                    <td><p>{{ $user->phone }}</p></td>
                    <td><p>{{ $user->role }}</p></td>
                    <td><p>{{ $user->avatar }}</p></td>
                    <td><p>{{ $user->created_at }}</p></td>
                    <td><p>{{ $user->updated_at }}</p></td>
                  </tr>
                @endforeach
            </table>
        </div>
    </main>
    {{ $users->appends(request()->except('page'))->links('vendor.pagination.custom_pagination') }}
</body>
<script>
    function search(){
        const newUrl = new URL(window.location.href)
        const search_column = document.getElementById('columnsearch').value
        const search_column_value = document.getElementById('search_input').value
        // const order = document.getElementById('order').value
        // newUrl.searchParams.set('order',order);
        if(search_column_value){
            newUrl.searchParams.set('search-column', search_column);
            newUrl.searchParams.set('search-column-value', search_column_value);
        }
        window.location.href=newUrl.href
    }
</script>
</html>