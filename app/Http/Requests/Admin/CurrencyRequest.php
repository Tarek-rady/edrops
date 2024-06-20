<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
            'code'  => $this->method() == "POST" ? 'required|max:255|unique:currencies,code' : 'required|max:255|unique:currencies,code,'.$this->id ,
            'exchange'  => 'required|numeric' ,

        ];
    }
}
