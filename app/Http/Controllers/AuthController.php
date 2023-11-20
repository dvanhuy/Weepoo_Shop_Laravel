<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ForgotPassRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    public function getFormLogin()
    {
        return view("Auth.loginAndRegister");
    }

    public function login(LoginRequest $loginRequest)
    {
        if (Auth::attempt($loginRequest->validated())) {
            $loginRequest->session()->regenerate();
            return redirect()->route('get_home_page');
        }
        return redirect()->back()->with([
            'fail' => 'Nhập sai email hoặc mật khẩu'
        ]);
    }

    public function getFormRegister()
    {
        return view("Auth.loginAndRegister");
    }

    public function register(RegisterRequest $request)
    {
        $params = $request->validated();
        $params['passwordreg'] = bcrypt($params['passwordreg']);
        //vì tên biến khác
        $user = User::create([
            'name' => $params['namereg'],
            'email' => $params['emailreg'],
            'password' => $params['passwordreg']
        ]);


        if ($user) {
            return redirect()->route('get_form_login')->with('emailfill',$params['emailreg']);
        }

        return redirect()->back()->with([
            'failreg' => 'Có lỗi khi tạo tài khoản'
        ]);
    }

    public function getHomePage()
    {
        return view('homepage');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }


    public function getFormForgotpass()
    {
        return view('Auth.forgotPassword');
    }

    public function sendMailResetPass(ForgotPassRequest $request){
        $user_email = $request->validated();
        $user = User::where('email',$user_email) -> first();
        if(!$user->email_verified_at){
            //email chưa được xác nhận
            return redirect()->back()->with('fail','Email chưa được xác nhận');
        };
        $token = Password::broker()->createToken($user);
        $user->sendPasswordResetNotification($token);
        return redirect()->back()->with('fail','Đã gửi');
    }

    public function getFormResetPassword(Request $request)
    {
        
        return view('Auth.resetPassword',['token'=> $request->token,'emailfill'=> $request->email]);
    }

    public function resetpassword(PasswordResetRequest $request)
    {
        $passwordreset = DB::table('password_resets')
            ->where('email', $request->email)
            ->first();
        $inputToken = $request->tokenreset;
        $storedToken = $passwordreset->token;
        if (Hash::check($inputToken, $storedToken)){
            if ($request->newpassword===$request->confirmpassword){
                User::where('email', $request->email)
                    ->update(['password' => bcrypt($request->newpassword)]);
                return redirect()->back()->with('status','Đổi mật khẩu thành công');
            }
            return redirect()->back()->with('status','Xác nhận mật khẩu không trùng khớp');
        }
        return redirect()->back()->with('status','Yêu cầu này không trùng khớp');
    }
}
