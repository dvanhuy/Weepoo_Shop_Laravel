<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tokenreset' => ['required'],
            'email' => ['required','max:255','min:5','email','exists:password_resets,email'],
            'newpassword' => ['required','min:5','max:255'],
            'confirmpassword' => ['required','min:5','max:255'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Bạn chưa điền email',
            'email.max' => 'Email quá dài',
            'email.email' => 'Email phải có chứa dấu @',
            'email.min' => 'Email phải dài hơn 5 kí tự',
            'email.exists' => 'Email không tồn tại hoặc chưa gửi yêu cầu đổi mật khẩu',
            'newpassword.required' => 'Bạn chưa điền mật khẩu',
            'newpassword.min' => 'Mật khẩu phải dài hơn 5 kí tự',
            'newpassword.max' => 'Mật khẩu quá dài',
            'confirmpassword.required' => 'Bạn chưa xác nhận mật khẩu',
            'confirmpassword.min' => 'Mật khẩu phải dài hơn 5 kí tự',
            'confirmpassword.max' => 'Mật khẩu quá dài',
            'tokenreset.required'=> 'Đã có yêu cầu khác từ tài khoản này',
        ] ;
    }
}
