<?php

namespace App\Http\Requests\Saller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RateRequest extends FormRequest
{

    public function rules()
    {
        return [
            'product_id'   => ['required', 'exists:products,id'],
            'msg'   => ['nullable', 'string'],
            'rate' => ['required']
        ];
    }
         
    public function attributes()
    {
        return[

            'product_id'  => 'المنتج',
            'msg'  => 'ملاحظات المنتج',
            'rate'  => 'تقييم المنتج'
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        $errors = $validator->errors();
        $errorKey = $errors->keys()[0];
        $errorMessage =  str_replace('.', '', $errors->first());

        throw new HttpResponseException(      
            response()->json([
                'success' => false,
                'message' => $errorMessage
            ])
        );
    }
}
