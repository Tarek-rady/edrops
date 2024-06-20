<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class ProductImg extends Model
{
    use HasFactory;


    protected $guarded = [];

    // get Size translation
    public function getSizeAttribute()
    {
        return $this->attributes['size_' . app()->getLocale()];
    } // end getSizeAttribute


      // get Color translation
      public function getColorAttribute()
      {
          return $this->attributes['color_' . app()->getLocale()];
      } // end getColorAttribute


    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function country(){
        return $this->belongsTo(Country::class , 'country_id');
    }

}
