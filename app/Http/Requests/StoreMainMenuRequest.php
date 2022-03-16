<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreMainMenuRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'image'=>'required|image|mimes:png,jpg,jpeg|max:2048',
            'name_az' => ['required','max:200','unique:main_menus,name_az'],
            'name_en' => ['required','max:200','unique:main_menus,name_en'],
            'name_ru' => ['required','max:200','unique:main_menus,name_ru'],
            'description_az' => ['required','max:200'],
            'description_en' => ['required','max:200'],
            'description_ru' => ['required','max:200'],
        ];
    }

    public function attributes()
    {
        return [
            'image' => 'Şəkil',
            'name_az' => __('static.name_az'),
            'name_en' => __('static.name_en'),
            'name_ru' => __('static.name_ru'),
            'description_az' => 'Təsvir(AZ)',
            'description_en' => 'Təsvir(EN)',
            'description_ru' => 'Təsvir(RU)'
        ];
    }
}
