<?php

namespace App\Http\Requests\Saller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PayoutRequest extends FormRequest
{

    public function rules()
    {
        return [
            'amount' => ['required', 'numeric', function ($attribute, $value, $fail) {
                $seller = auth()->user()->saller; // Get authenticated user
                if (!$seller || $seller->amount < $value) {
                    $fail('رصيد المحفظة غير كافي.');
                }
            }],
            'method'   => ['required', 'in:bank,wallet,western_union'],
            'account_holder_name' => ['required_if:method,bank'],
            'iban' => ['required_if:method,bank'],
            'swift_code' => ['required_if:method,bank'],
            'wallet_name' => ['required_if:method,wallet'],
            'wallet_no' => ['required_if:method,wallet'],
            'english_name' => ['required_if:method,western_union'],
            'phone' => ['required_if:method,western_union'],
            'country' => ['required_if:method,western_union'],
            'city' => ['required_if:method,western_union'],
        ];
    }
         
    public function attributes()
    {
        return[

            'amount'  => 'مبلغ السحب',
            'method' => 'طريقة السحب',
            'account_holder_name' => 'إسم صاحب الحساب',
            'iban' => 'رقم iban',
            'swift_code' => 'رمز السويفت كود',
            'wallet_name' => 'إسم المحفظة',
            'wallet_no' => 'رقم المحفظة',
            'english_name' => 'الإسم باللغة الانجليزية',
            'phone' => 'رقم الجوال',
            'country' => 'الدولة',
            'city' => 'المدينة'
        ];
        
    }

    public function failedValidation(Validator $validator)
    {
        
        throw new HttpResponseException(      
            response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ])
        );
    }
}
