<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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


    public function sallers(){
        return $this->hasMany(Admin::class , 'city_id')->where('type' , 'saller');
    }

    public function users(){
        return $this->hasMany(User::class , 'city_id');
    }


}
