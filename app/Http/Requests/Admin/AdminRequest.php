<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [
            'name'       => 'required|max:255' ,
            'img'        =>$this->method() == 'POSt' ? 'required|mimes:png,jpg,jpeg'  : 'nullable|mimes:png,jpg,jpeg',
            'email'      => $this->method() == 'POSt' ? 'required|unique:admins,email' : 'required|unique:admins,email,' . $this->id,
            'password'   => $this->method() == "POST" ?  'required|min:3|max:255' : 'nullable|min:3|max:255'  ,
            'role_id' => 'required' ,

        ];
    }
}
