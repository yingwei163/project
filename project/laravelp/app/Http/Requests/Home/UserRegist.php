<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class UserRegist extends FormRequest
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
            'name'=>'required|min:3',
            'email'=>'required|email',
            'pwd'=>'required|confirmed',
            'pwd_confirmation'=>'required',
            'save'=>'accepted',
            'code'=>'captcha',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名不能小于3位',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
//            'email.unique'=>'邮箱已被注册',
            'pwd.required'=>'密码不能为空',
            'pwd.confirmed'=>'密码不一致',
            'pwd_confirmation.required'=>'确认密码不一致',
            'save.accepted'=>'请确认已阅读规则并勾选',
            'code.captcha'=>'验证码错误',

        ];
    }
}
