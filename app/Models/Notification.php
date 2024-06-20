<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    protected $guarded = [];

    // get Title translation
    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    } // end getTitleAttribute





    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

    public function saller(){
        return $this->belongsTo(Saller::class , 'saller_id');
    }

    public function order(){
        return $this->belongsTo(Order::class , 'order_id');
    }

}
