<?php

namespace App\Http\Requests\Home;

use Illuminate\Foundation\Http\FormRequest;

class AddrageComic extends FormRequest
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
            'channel'=>'required',
            'content'=>'required',
        ];
    }
    public function messages()
    {
       return[
           'title.required'=>'作品内容未填写',
           'channel.required'=>'请选择频道',
           'content.required'=>'请选择你的作品',
       ];
    }
}
