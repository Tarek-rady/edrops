<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true ;
    }


    public function rules(): array
    {
        return [

            'name_ar'               => 'required|max:255' ,
            'name_en'               => 'required|max:255' ,
            'desc_ar'               => 'required' ,
            'desc_en'               => 'required' ,
            'price'                 => 'required' ,
            'qty'                   => 'required' ,
            'category_id'           => 'required' ,
            'country_id'            => 'required' ,
            'sku'                   => $this->method() == "POST" ? 'nullable' : 'required|unique:products,sku,'.$this->id ,
            'cost_user'             => 'required|numeric' ,
            'amazon'                => 'nullable' ,
            'youtube'               => 'nullable' ,
            'stock'                 => 'required' ,
            'use_product_ar'        => 'required' ,
            'use_product_en'        => 'required' ,
            'note_ar'               => 'required' ,
            'note_en'               => 'required' ,
            'populer_ar'            => 'required' ,
            'populer_en'            => 'required' ,
            'adv_ar'                => 'required' ,
            'adv_en'                => 'required' ,
            'ratio'                 => 'nullable|numeric|min:1|max:10' ,
            'delivery'              => 'nullable|numeric|min:1|max:10' ,
            'competition'           => 'nullable|numeric|min:1|max:10' ,
            'img'                   => $this->method() == "POST" ? 'required|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg'

        ];
    }
}
