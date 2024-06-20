<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'name_ar'  => 'required|max:255' ,
            'name_en'  => 'required|max:255' ,
            'phone_key'=> 'required|numeric' ,
            'delivery' => 'required|numeric' ,
            'time'     => 'required|numeric' ,


            'img'     => $this->method() == "POST" ? 'required|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg'

        ];
    }
}
