<?php

namespace App\Http\Requests\Figure;

use Illuminate\Foundation\Http\FormRequest;

class AddFigureRequest extends FormRequest
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
            "ten"=> ["required","max:255"],
            "gia"=> ["required","numeric","digits_between:1,30"],
            "so_luong_hien_con"=> ["required","numeric","digits_between:1,10"],
            "so_luong_da_ban"=> ['nullable',"digits_between:1,10","numeric"],
            "nha_sx"=> ['nullable',"max:255"],
            "chieu_cao"=> ['nullable',"numeric","digits_between:1,10"],
            "chieu_rong"=> ['nullable',"numeric","digits_between:1,10"],
            "chieu_dai"=> ['nullable',"numeric",'digits_between:1,10'],
            "chat_lieu"=> ['nullable',"max:255"],
            "mo_ta"=> ['nullable'],
            "hinh_anh"=> ['nullable'],
        ];
    }
}
