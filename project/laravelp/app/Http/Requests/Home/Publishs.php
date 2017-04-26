<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class Publishs extends FormRequest
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
            'title'=>'required',
            'cover'=>'required',
            'bimgw'=>'required',
        ];
    }
    public function messages()
    {
        return[
            'title.required'=>'作品标题未填写',
            'cover.required'=>'请选择你的连载封面',
            'bimgw.required'=>'请选择你的作品',
        ];
    }
}
