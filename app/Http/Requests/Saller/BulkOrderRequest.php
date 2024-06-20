<?php

namespace App\Http\Requests\Saller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class BulkOrderRequest extends FormRequest
{

    public function rules()
    {
        return [
            'orders.*.customer_name'   => ['required', 'string'],
            'orders.*.phone'   => ['required', 'string'],
            'orders.*.country' => ['required', 'exists:countries,id'],
            'orders.*.city'   => ['required'],
            'orders.*.address'   => ['required'],
            'orders.*.products'   => ['required'],
            'orders.*.products.*.sku' => ['required', 'exists:products,sku'],
            'orders.*.products.*.selling_price'   => ['required'],
            'orders.*.products.*.qty'   => ['required']
        ];
    }
         
    public function attributes()
    {
        return[

            'orders.*.customer_name'  => 'أسم العميل',
            'orders.*.phone'  => 'رقم هاتف العميل',
            'orders.*.country'  => 'الدولة',
            'orders.*.city'  => 'المدينة',
            'orders.*.address'  => 'العنوان التفصيلي',
            'orders.*.products'  => 'المنتجات',
            'orders.*.products.*.sku' => 'المنتج',
            'orders.*.products.*.selling_price' => 'سعر البيع',
            'orders.*.products.*.qty' => 'الكمية'
        ];
        
    }
    public function messages()
    {
        return [
            'orders.*.customer_name.required'   => 'حقل :attribute مطلوب',
            'orders.*.phone.required'           => 'حقل :attribute مطلوب',
            'orders.*.country.required'         => 'حقل :attribute مطلوب',
            'orders.*.country.exists'           => ':attribute غير موجوده  ',
            'orders.*.city.required'            => 'حقل :attribute مطلوب',
            'orders.*.address.required'         => 'حقل :attribute مطلوب',
            'orders.*.products.required'        => 'حقل :attribute مطلوب',
            'orders.*.products.*.sku.required'  => 'حقل :attribute مطلوب',
            'orders.*.products.*.sku.exists'    => ':attribute غير موجود',
            'orders.*.products.*.selling_price.required'   => 'حقل :attribute مطلوب',
            'orders.*.products.*.qty.required'  => 'حقل :attribute مطلوب'
        ];
    }
    public function failedValidation(Validator $validator)
    {
        
        $errors = $validator->errors();
        $errorKey = $errors->keys()[0];
        $order_num = explode('.', $errors->keys()[0])[1];
        $errorMessage = 'الطلب رقم : ' . $order_num+1 . PHP_EOL;
        $errorMessage .=  str_replace('.', '', $errors->first());

        throw new HttpResponseException(      
            response()->json([
                'success' => false,
                'message' => $errorMessage
            ])
        );
    }
}
