<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SallerProduct extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function saller(){
        return $this->belongsTo(Admin::class , 'admin_id')->where('type' , 'saller');
    }
}
