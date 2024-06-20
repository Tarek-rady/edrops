<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'name_ar'        => 'required|max:255' ,
            'name_en'        => 'required|max:255' ,
            'link'           => 'nullable|max:255' ,
            'country_id'     => 'required' ,
            'city_id'        => 'required' ,

        ];
    }
}
