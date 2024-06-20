<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    use HasFactory;


    protected $guarded = [];

    // function get saller
    public function saller()
    {
        return $this->belongsTo(Saller::class , 'saller_id');
    }

    public function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    // function get admin
    public function admin()
    {
        return $this->belongsTo(Admin::class , 'admin_id');
    }


    // function get order
    public function order()
    {
        return $this->belongsTo(Order::class , 'order_id');
    }

}
