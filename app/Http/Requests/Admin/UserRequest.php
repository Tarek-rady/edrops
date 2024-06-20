<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'name'       => 'required|max:255' ,
            'email'      => $this->method() == "POST" ? 'required|email|unique:users,email' : 'required|email|unique:users,email,'.$this->id ,
            'phone'      => 'required|numeric' ,
            'country_id' => 'required' ,
            'city_id'    => 'required' ,
            'company'    => 'required' ,
            'img'        => $this->method() == "POST" ? 'required|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg'

        ];
    }
}
