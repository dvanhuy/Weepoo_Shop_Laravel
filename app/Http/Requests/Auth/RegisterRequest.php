<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'namereg' => ['required','max:255','min:5'],
            'emailreg' => ['required','max:255','min:5','email','unique:users,email'],
            'passwordreg' => ['required','min:5','min:255'],
        ];
    }

    public function messages(){
        return [
            'namereg.required' => 'Bạn chưa điền tên tài khoản',
            'namereg.min' => 'Tên người dùngphải dài hơn 5 kí tự',
            'namereg.max' => 'Tên người dùng quá dài',
            'emailreg.required' => 'Bạn chưa điền email',
            'emailreg.max' => 'Email quá dài',
            'emailreg.email' => 'Email phải có chứa dấu @',
            'emailreg.min' => 'Email phải dài hơn 5 kí tự',
            'emailreg.unique' => 'Email đã tồn tại',
            'passwordreg.required' => 'Bạn chưa điền mật khẩu',
            'passwordreg.min' => 'Mật khẩu phải dài hơn 5 kí tự',
            'passwordreg.max' => 'Mật khẩu quá dài',
        ];
    }
}
