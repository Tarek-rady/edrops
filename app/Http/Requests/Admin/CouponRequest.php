<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'code'  => $this->method() == "POST" ? 'required|unique:coupons,code' : 'required|unique:coupons,code,' . $this->id ,
            'type'  => 'required' ,
            'value'  => 'required' ,
            'cart_value'  => 'required' ,
            'start_date'  => 'required' ,
            'expiry_date'  => 'required' ,

        ];
    }
}
