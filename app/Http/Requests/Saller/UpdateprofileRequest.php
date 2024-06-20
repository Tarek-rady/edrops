<?php

namespace App\Http\Requests\Saller;

use Illuminate\Foundation\Http\FormRequest;

class UpdateprofileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'name'        => 'required|max:255' ,
            'email'       => $this->method() == 'post' ? 'required|max:255|email|unique:admins,email' : 'required|max:255|email|unique:admins,email,'.$this->admin_id,
            'first_name'  => 'required|max:255' ,
            'last_name'   => 'required|max:255' ,
            'country_id'  => 'required' ,
            'city_id'     => 'required' ,
            'region'      => 'required|max:255' ,
            'address'     => 'required|max:255' ,
            'address_2'   => 'required|max:255' ,
            'company'     => 'required|max:255' ,
            'phone'       =>$this->method() == "POST" ? 'required|numeric|unique:sallers,phone' : 'required|numeric|unique:sallers,phone,'.$this->id ,
            'facebook'    => 'nullable|max:255' ,
            'instagram'   => 'nullable|max:255' ,
            'shopify'     => 'nullable|max:255' ,
            'img'         => $this->method() == "POST" ? 'nullable|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg' ,
            'logo'         => $this->method() == "POST" ? 'nullable|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg'

        ];
    }
}
