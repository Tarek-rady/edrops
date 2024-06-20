<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $guarded = [];

    // get Name translation
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getNameAttribute

    public function products(){
        return $this->hasMany(Product::class , 'category_id');
    }

    public function brand_products(){
        return $this->hasMany(Product::class , 'brand_id');
    }


   

}
