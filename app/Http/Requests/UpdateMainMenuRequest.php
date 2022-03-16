<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateMainMenuRequest extends FormRequest
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
            'image'=>'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'name_az' => ['required','max:200',Rule::unique('main_menus','name_az')->where(function ($query) use ($request) {
                return $query->where('main_menu_id','!=',$request->main_menu_id);
            })],
            'name_en' => ['required','max:200',Rule::unique('main_menus','name_en')->where(function ($query) use ($request) {
                return $query->where('main_menu_id','!=',$request->main_menu_id);
            })],
            'name_ru' => ['required','max:200',Rule::unique('main_menus','name_ru')->where(function ($query) use ($request) {
                return $query->where('main_menu_id','!=',$request->main_menu_id);
            })],
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
