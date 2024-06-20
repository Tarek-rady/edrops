<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;


    protected $guarded = [];

    // get Name translation
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getNameAttribute


    public function country(){
       return $this->belongsTo(Country::class , 'country_id');
    }

    public function city(){
        return $this->belongsTo(City::class , 'city_id');
    }

    public function products(){
        return $this->hasMany(product::class , 'stock_id');
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class , 'role_stocks');
    }

}
