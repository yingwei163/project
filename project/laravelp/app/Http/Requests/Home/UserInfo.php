<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class UserInfo extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'bir'=>'required',
            'sex'=>'required',
            'addr'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'bir.required'=>'生日不能为空',
            'sex.required'=>'性别不能为空',
            'addr.required'=>'地址不能为空',
        ];
    }
}
