<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saller extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function admin(){
           return $this->belongsTo(Admin::class , 'admin_id');
    }


    public function country(){
        return $this->belongsTo(Country::class , 'country_id');
    }


    public function city(){
        return $this->belongsTo(City::class , 'city_id');
    }

    public function products(){
        return $this->belongsTo(SallerProduct::class , 'saller_id');
    }

    public function orders(){
        return $this->belongsTo(Order::class , 'saller_id');
    }


    public function rates(){
        return $this->hasMany(Rate::class , 'saller_id')->where('type' , 'sallers');
    }


    public function profits(){
        return $this->hasMany(Profit::class , 'saller_id');
    }

    public function pulls(){
        return $this->hasMany(Pull::class , 'saller_id');
    }

    public function point(){
        return $this->belongsTo(Point::class , 'point_id');
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

    public function getAmountAttribute($amount){

        if($saller = auth('admin')->user()->saller){
            $currency = Currency::find($saller->currency ?? 1);

            $amount = round($amount*$currency->exchange,2);
        }

        return $amount;
    }

    public function sum_pull(){

        $sum_pull = $this->pulls()->sum('pull');

        if($saller = auth('admin')->user()->saller){
            $currency = Currency::find($saller->currency);
            $sum_pull = round($sum_pull*$currency->exchange,2);
        }

        return $sum_pull;
    }

}
