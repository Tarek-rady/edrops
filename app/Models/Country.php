<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;


    protected $guarded = [];

    // get Name translation
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getNameAttribute


    public function cities(){
        return $this->hasMany(City::class , 'country_id');
    }


    public function products(){
        return $this->hasMany(Product::class , 'country_id');
    }

    public function sallers(){
        return $this->hasMany(Admin::class , 'country_id')->where('type' , 'saller');
    }

    public function users(){
        return $this->hasMany(User::class , 'country_id');
    }

    public function wallets(){
        return $this->hasMany(CountryCash::class , 'country_id');
    }




}
