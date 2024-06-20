<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasFactory, Notifiable, HasApiTokens;


    protected $guarded = [] ;



    public function products(){
        return $this->hasMany(Product::class , 'user_id');
    }


    public function country(){
        return $this->belongsTo(Country::class , 'country_id');
    }


    public function city(){
        return $this->belongsTo(City::class , 'city_id');
    }



    public function profits(){
        return $this->hasMany(Profit::class , 'user_id');
    }

    public function pulls(){
        return $this->hasMany(Pull::class , 'user_id');
    }

    public function notifications(){
        return $this->hasMany(Notification::class , 'user_id')->where('type' , 'users');
    }






    protected $hidden = [
        'password',
        'remember_token',
    ];



    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
