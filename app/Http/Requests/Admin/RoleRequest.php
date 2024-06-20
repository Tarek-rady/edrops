<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [
           'name'  => $this->method() == "POST" ? 'required|unique:roles,name' : 'required|unique:roles,name,'.$this->id
        ];
    }
}
