<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'name_ar'  => $this->method() == "POST" ? 'required|max:255|unique:categories,name_ar' : 'required|max:255|unique:categories,name_ar,' . $this->id ,
            'name_en'  => $this->method() == "POST" ? 'required|max:255|unique:categories,name_en' : 'required|max:255|unique:categories,name_en,' . $this->id ,
            'img'     => $this->method() == "POST" ? 'required|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg'

        ];
    }
}
