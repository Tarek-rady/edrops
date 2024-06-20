<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;

class Order extends Model
{
    use HasFactory;


    protected $guarded = [];


    // function get saller
    public function saller()
    {
        return $this->belongsTo(Saller::class , 'saller_id');
    }

     // function get user
     public function user()
     {
         return $this->belongsTo(User::class , 'user_id');
     }
    // function get status
    public function status()
    {
        return $this->belongsTo(Status::class , 'status_id');
    }

    public function rate()
    {
        return $this->hasOne(Rate::class , 'order_id');
    }



    // function has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class , 'order_id');
    }

    // function has many items
    public function cart_items()
    {
       return $this->hasMany(OrderItem::class , 'order_id');
    }


    public function order_country()
    {
        return $this->belongsTo(Country::class , 'country');
    }

    public function order_city()
    {
        return $this->belongsTo(City::class , 'city');
    }



}
