<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [


            'rate'        => 'required|min:1|max:5' ,
            'msg'         => 'required' ,
            'user_name'   => 'required|max:255' ,
            'country_id'  =>  'required'

        ];
    }
}
