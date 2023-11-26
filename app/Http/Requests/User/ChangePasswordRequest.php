<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            "password"=> ['required','min:5','max:255'],
            'newpassword' => ['required','min:5','max:255'],
            'confirmpassword' => ['required','min:5','max:255'],
        ];
    }
    public function messages()
    {
        return [
            'password.required'=> 'Bắt buộc nhập mật khẩu',
            'password.min'=> 'Ít nhất 5 kí tự',
            'password.max'=> 'Quá dài',
            'newpassword.required'=> 'Bắt buộc nhập mật khẩu',
            'newpassword.min'=> 'Ít nhất 5 kí tự',
            'newpassword.max'=> 'Quá dài',
            'confirmpassword.required'=> 'Bắt buộc nhập mật khẩu',
            'confirmpassword.min'=> 'Ít nhất 5 kí tự',
            'confirmpassword.max'=> 'Quá dài',
        ] ;
    }
}