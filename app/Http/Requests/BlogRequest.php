<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'image'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            'title_az'=>'required|max:191',
            'title_en'=>'required|max:191',
            'title_ru'=>'required|max:191',
            'sub_title_az'=>'required|max:191',
            'sub_title_en'=>'required|max:191',
            'sub_title_ru'=>'required|max:191',
            'content_az'=>'required|max:65535',
            'content_en'=>'required|max:65535',
            'content_ru'=>'required|max:65535'
        ];
    }

    public function attributes()
    {
        return [
            'image'=>'Şəkil',
            'title_az'=>'Başlıq(AZ)',
            'title_en'=>'Başlıq(EN)',
            'title_ru'=>'Başlıq(RU)',
            'sub_title_az'=>'Alt Başlıq(AZ)',
            'sub_title_en'=>'Alt Başlıq(EN)',
            'sub_title_ru'=>'Alt Başlıq(RU)',
            'content_az'=>'Məzmun(AZ)',
            'content_en'=>'Məzmun(EN)',
            'content_ru'=>'Məzmun(RU)'
        ];
    }
}
