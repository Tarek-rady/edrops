<?php

namespace App\Http\Requests\Saller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CartOrderRequest extends FormRequest
{

    public function rules()
    {
        return [
            'customer_name'   => ['required', 'string'],
            'country' => ['required', 'exists:countries,id'],
            'city'   => ['required', 'exists:cities,id'],
            'country_code' => ['required'],
            'phone'   => ['required', 'string' , 'min:8' , 'max:10'],
            'address'   => ['required'],

            'products.*.qty'   => ['required']
        ];
    }

    public function attributes()
    {
        return[

            'customer_name'  => 'أسم العميل',
            'phone'  => 'رقم هاتف العميل',
            'country'  => 'الدولة',
            'city'  => 'المدينة',
            'country_code'  => 'رمز الدولة',
            'address'  => 'العنوان التفصيلي',
            'products.*.product_selling_price' => 'سعر البيع',
            'products.*.qty' => 'الكمية'
        ];

    }
    public function messages()
    {
        return [
            'customer_name.required'   => 'حقل :attribute مطلوب',
            'phone.required'           => 'حقل :attribute مطلوب',
            'country.required'         => 'حقل :attribute مطلوب',
            'country.exists'           => ':attribute غير موجوده  ',
            'city.required'            => 'حقل :attribute مطلوب',
            'country_code.required'    => 'حقل :attribute مطلوب',
            'address.required'         => 'حقل :attribute مطلوب',
            'products.required'        => 'حقل :attribute مطلوب',
            'products.*.product_selling_price.required'   => 'حقل :attribute مطلوب',
            'products.*.qty.required'  => 'حقل :attribute مطلوب'
        ];
    }
    public function failedValidation(Validator $validator)
    {

        $errors = $validator->errors();
        $errorMessage =  str_replace('.', '', $errors->first());

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $errorMessage
            ])
        );
    }
}
