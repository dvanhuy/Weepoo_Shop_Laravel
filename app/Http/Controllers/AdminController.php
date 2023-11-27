<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Figure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function getFiguresForm(Request $request){
        $figures= Figure::getQuery();

        if($request->has("search-column") && $request->has("search-column-value")){
            // có mệnh đề where
            $figures =  $figures->where($request->input("search-column"), 'like', '%'.$request->input("search-column-value").'%');
        }

        if($request->has("order")){
            //có tham số order -> nhấn vào nút tìm
            switch ($request->input("order")) {
                case 'priceasc':
                    $figures = $figures->orderByRaw('gia * 1 asc');
                    break;
                case 'pricedesc':
                    $figures = $figures->orderByRaw('gia * 1 desc');
                    break;
                case 'oldest':
                    $figures = $figures->orderBy('updated_at', 'asc');
                    break;
                case 'recently':
                    $figures = $figures->orderBy('updated_at', 'desc');
                    break;
                default:
                    $figures = $figures->orderBy('updated_at', 'desc');
            }
        }
        else {
            $figures = $figures->orderBy('updated_at', 'desc');
        }
        
        $figures=$figures->paginate(30);
        return view("Admin.manageFigures",["figures"=> $figures]);
    }
    public function getUsersForm(Request $request){

        if($request->has("search-column") && $request->has("search-column-value")){
            // có mệnh đề where
            $users= User::where($request->input("search-column"), 'like', '%'.$request->input("search-column-value").'%')
                            ->orderBy('updated_at', 'desc')
                            ->paginate(15);
            return view("Admin.manageUsers",["users"=> $users]);
        }
        $users= User::orderBy('updated_at', 'desc')->paginate(15);
        return view("Admin.manageUsers",["users"=> $users]);
    }

    public function getFormUpdateUser(User $userID)
    {
        return view("Admin.update_user",["user"=> $userID]);
    }

    public function updateUser(UpdateUserRequest $request, User $userID)
    {
        $user = $request->validated();
        if ($request->hasFile('avatar')) {
            //xóa ảnh cũ
            $old_image_path = $userID['avatar'];
            if(File::exists($old_image_path) && $old_image_path != 'images/avatardefault.png') {
                File::delete($old_image_path);
            }
            $new_image_path = Storage::disk('public')->put("images/users", $request->file('avatar'));
            $user['avatar']='storage/'.$new_image_path;
        }
        $status = $userID->update($user);
        if ($status) {
            return redirect()->back()->with([
                'status' => 'Đã cập nhật thông tin thành công'
            ]);
        }
        return redirect()->back()->with([
            'status' => 'Cập nhật thất bại'
        ]);
    }
    public function deleteUser(User $userID)
    {
        $check = $userID->delete();
        if ($check) {
            return redirect()->back()->with([
                'status' => 'Đã xóa mô hình thành công'
            ]);
        }
        return redirect()->back()->with([
            'status' => 'Xóa mô hình thất bại'
        ]);
    }
}
