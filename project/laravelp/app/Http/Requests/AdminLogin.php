<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLogin extends FormRequest
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
            'name'=>'required|min:6',
            'password'=>'required',
        ];
    }
    public function messages()
    {
       return [
           'name.required'=>'用户名不能为空',
           'name.min'=>'请输入大与6个字符的用户名',
           'password.required'=>'密码不能为空',
       ];
    }
}
