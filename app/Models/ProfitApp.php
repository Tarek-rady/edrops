<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitApp extends Model
{
    use HasFactory;


    protected $guarded = [];


    public function product(){
        return $this->belongsTo(Product::class , 'product_id');
    }


}
