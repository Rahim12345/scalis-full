<?php

namespace App\Http\Requests;

use App\Rules\MetaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMetaRequest extends FormRequest
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
            'menus'=>['required', Rule::in(['main_page', 'about_page', 'brends_page', 'career_page', 'contact_page'])],
            'name_title'=>['required','max:100', new MetaRule()],
            'name_description'=>['required','max:100', new MetaRule()],
            'property_og_site_name'=>['required','max:100', new MetaRule()],
            'property_og_url'=>['required','max:100', new MetaRule()],
            'property_og_title'=>['required','max:100', new MetaRule()],
            'property_og_description'=>['required','max:100', new MetaRule()],
            'property_twitter_url'=>['required','max:100', new MetaRule()],
            'property_twitter_title'=>['required','max:100', new MetaRule()],
            'property_twitter_description'=>['required','max:100', new MetaRule()],
        ];
    }

    public function messages()
    {
        return [
            'name_title.required'=>'<meta name="title" content=" Tələb olunur ">',
            'name_title.max'=>'<meta name="title" content=" Maksimum 100 simvol ola bilər ">',

            'name_description.required'=>'<meta name="description" content=" Tələb olunur ">',
            'name_description.max'=>'<meta name="description" content=" Maksimum 100 simvol ola bilər ">',

            'property_og_site_name.required'=>'<meta property="og:site_name" content=" Tələb olunur ">',
            'property_og_site_name.max'=>'<meta property="og:site_name" content=" Maksimum 100 simvol ola bilər ">',

            'property_og_url.required'=>'<meta property="og:url" content=" Tələb olunur ">',
            'property_og_url.max'=>'<meta property="og:url" content=" Maksimum 100 simvol ola bilər ">',

            'property_og_title.required'=>'<meta property="og:title" content=" Tələb olunur ">',
            'property_og_title.max'=>'<meta property="og:title" content=" Maksimum 100 simvol ola bilər ">',

            'property_og_description.required'=>'<meta property="og:description" content=" Tələb olunur ">',
            'property_og_description.max'=>'<meta property="og:description" content=" Maksimum 100 simvol ola bilər ">',

            'property_twitter_url.required'=>'<meta property="twitter:url" content=" Tələb olunur ">',
            'property_twitter_url.max'=>'<meta property="twitter:url" content=" Maksimum 100 simvol ola bilər ">',

            'property_twitter_title.required'=>'<meta property="twitter:title" content=" Tələb olunur ">',
            'property_twitter_title.max'=>'<meta property="twitter:title" content=" Maksimum 100 simvol ola bilər ">',

            'property_twitter_description.required'=>'<meta property="twitter:description" content=" Tələb olunur ">',
            'property_twitter_description.max'=>'<meta property="twitter:description" content=" Maksimum 100 simvol ola bilər ">',
        ];
    }
}
