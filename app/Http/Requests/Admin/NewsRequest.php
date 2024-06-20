<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'title_ar'  => 'required|max:255' ,
            'title_en'  => 'required|max:255' ,
            'desc_ar'  => 'required' ,
            'desc_en'  => 'required' ,
            'img'     => $this->method() == "POST" ? 'required|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg'

        ];
    }
}
