<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function callApiGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            // dd($googleUser);
            $existingUser = User::where('email', $googleUser->email)->first();
            if ($existingUser) {
                // đã tồn tại trong hệ thống -> đăng nhập vô
                Auth::login($existingUser, true);
                return redirect()->route('get_home_page');
            };
            //chưa vô lần nào -> tạo acc
            $userinfor = [
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'social_id'=> $googleUser->id,
                'social_type' => 'google',
                'password' => bcrypt($googleUser->id),
                'avatar' => $googleUser->avatar,
            ];

            $user = User::create($userinfor);
            if ($user) {
                Auth::login($user, true);
                return redirect()->route('get_home_page');
            }

            return redirect()->back()->with([
                'fail' => 'Có lỗi khi đăng nhập bằng google',
            ]);

        } catch (\Exception $exception) {
            return redirect("/login")->with([
                'fail' => 'Có lỗi, vui lòng đợi vài phút để thực hiện lại',
            ]);
        }
    }
}
