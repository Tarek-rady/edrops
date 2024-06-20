<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TermRequest extends FormRequest
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
            'desc_ar'  => 'required' ,
            'desc_en'  => 'required' ,

        ];
    }
}
