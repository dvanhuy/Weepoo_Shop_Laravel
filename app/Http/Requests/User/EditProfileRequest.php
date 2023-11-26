<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            "name"=> ['required','max:255','min:5'],
            'phone'=> ['nullable','numeric','digits_between:10,11'],
            'avatar' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Tên không được để trống',
            'name.max'=> 'Tên quá dài',
            'name.min'=> 'Tên quá ngắn',
            'phone.numeric'=> 'Số điện thoại chỉ chứa số',
            'phone.digits_between'=> 'Số điện thoại từ 10 số -> 11 số',
        ] ;
    }
}