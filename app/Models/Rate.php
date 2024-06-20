<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;


    protected $guarded = [];



    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function saller(){
        return $this->belongsTo(Saller::class , 'saller_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id')->where('type' , 'admin');
    }

    public function order(){
        return $this->belongsTo(Order::class , 'order_id');
    }

    public function country(){
        return $this->belongsTo(Country::class , 'country_id');
    }


}
