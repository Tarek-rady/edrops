<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // get Name translation
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getNameAttribute


    // get Desc translation
    public function getDescAttribute()
    {
        return $this->attributes['desc_' . app()->getLocale()];
    } // end getDescAttribute

    // get use_product translation
    public function getUseProductAttribute()
    {
        return $this->attributes['use_product_' . app()->getLocale()];
    } // end getuse_productAttribute


    //
    public function getNoteAttribute()
    {
        return $this->attributes['note_' . app()->getLocale()];
    } // end getnoteAttribute

    public function getPopulerAttribute()
    {
        return $this->attributes['populer_' . app()->getLocale()];
    } // end getpopulerAttribute

    public function getAdvAttribute()
    {
        return $this->attributes['adv_' . app()->getLocale()];
    } // end getadvAttribute

    public function getPriceAttribute($price){

        if($saller = auth('admin')->user()->saller){
            $currency = Currency::find($saller->currency ?? 1);
            $price = round($price*$currency->exchange,2);
        }

        return $price;
    }

    public function getCostAttribute($cost){

        if($saller = auth('admin')->user()->saller){
            $currency = Currency::find($saller->currency ?? 1);
            $cost = round($cost*$currency->exchange,2);
        }

        return $cost;
    }

    public function getProfitAttribute($profit){

        if($saller = auth('admin')->user()->saller){
            $currency = Currency::find($saller->currency ?? 1);
            $profit = round($profit*$currency->exchange,2);
        }

        return $profit;
    }

    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function sallers(){
        return $this->belongsToMany(Admin::class, 'saller_products', 'product_id','saller_id');
    }

    public function country(){
        return $this->belongsTo(Country::class , 'country_id');
    }


    public function category(){
        return $this->belongsTo(Category::class , 'category_id')->where('type' , 'category');
    }

    public function brand(){
        return $this->belongsTo(Category::class , 'brand_id')->where('type' , 'brand');
    }

    public function store(){
       return $this->belongsTo(Stock::class , 'stock_id');
    }

    public function items(){
        return $this->hasMany(Cart::class , 'product_id');
    }

    public function profits(){
        return $this->hasMany(ProfitApp::class , 'product_id');
    }

    public function images(){
        return $this->hasMany(ProductImg::class , 'product_id')->where('type' , 'img');
    }

    public function countries(){
        return $this->hasMany(ProductImg::class , 'product_id')->where('type' , 'country');
    }

    public function sizes(){
        return $this->hasMany(ProductImg::class , 'product_id')->where('type' , 'size');
    }

    public function colors(){
        return $this->hasMany(ProductImg::class , 'product_id')->where('type' , 'color');
    }

    public function view_sallers(){
        return $this->hasMany(SallerProduct::class , 'product_id')->where('type' , 'products');
    }


    public function rates(){
        return $this->hasMany(Rate::class , 'product_id');
    }



    public function avg_rates()
    {
        $product_rated = $this->rates->where('rate', '!=', null)->count();

        if ($product_rated)
        {
            return number_format($this->rates->avg('rate') , 2);
        } else
        {
            return "0.00";
        }

    }

}
