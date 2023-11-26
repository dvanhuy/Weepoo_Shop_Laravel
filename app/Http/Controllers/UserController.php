<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\EditProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{   
    public function getFormEditProfile()
    {
        $user = Auth::user();
        return view("User.edit_profile",["user"=> $user]);
    }

    public function updateProfile(EditProfileRequest $request,User $userID)
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

    public function getFormChangePassword()
    {
        $user = Auth::user();
        return view("User.change_password",["user"=> $user]);
    }
    public function changePassword(ChangePasswordRequest $request,User $userID){
        $input = $request->validated();
        if (!Hash::check($input["password"], $userID['password'])) {
            return redirect()->back()->with([
                'status'=> 'Sai mật khẩu ban đầu'
            ]);
        }
        if ($input['newpassword'] !== $input['confirmpassword'] ) {
            return redirect()->back()->with([
                'status'=> 'Xác nhận mật khẩu không trùng khớp'
            ]);
        }
        $userID->password = bcrypt($input['newpassword']);
        $userID->save();
        return redirect()->back()->with([
            'status'=> 'Đổi mật khẩu thành công'
        ]);
    }
}