<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required','max:255','min:5','email'],
            'password' => ['required','min:5'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa điền email',
            'email.max' => 'Email quá dài',
            'email.email' => 'Email phải có chứa dấu @',
            'email.min' => 'Email phải dài hơn 5 kí tự',
            'password.required' => 'Bạn chưa điền mật khẩu',
            'password.min' => 'Mật khẩu phải dài hơn 5 kí tự',
        ];
    }
}
