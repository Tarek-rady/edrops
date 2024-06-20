<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'twitter' =>   'nullable'  ,
            'facebook' =>   'nullable'  ,
            'youtube' =>   'nullable'  ,
            'instagram' =>   'nullable'  ,
            'wattsapp' =>   'nullable|numeric'  ,
            'phone' =>   'nullable|numeric'  ,
            'delivery_price' =>   'nullable|numeric'  ,
            'email' =>   'nullable|email'  ,
            'gmail' =>   'nullable|email'  ,
            'logo'     => 'nullable|mimes:png,jpg,jpeg'

        ];
    }
}
