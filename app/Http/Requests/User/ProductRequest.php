<?php

namespace App\Http\Requests\User;

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
            'sku'                   => $this->method() == "POST" ? 'required|unique:products,sku' : 'required|unique:products,sku,'.$this->id ,
            'discount'              => 'nullable|numeric' ,
            'desc_ar'               => 'required' ,
            'desc_en'               => 'required' ,
            'qty'                   => 'required' ,
            'category_id'           => 'required' ,
            'country_id'            => 'required' ,
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
            'img'                   => $this->method() == "POST" ? 'required|mimes:png,jpg,jpeg' : 'nullable|mimes:png,jpg,jpeg'
        ];
    }
}
