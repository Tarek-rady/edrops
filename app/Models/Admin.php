<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Admin extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasRolesAndPermissions;

    protected $guarded = [];


    public function saller() {

        return $this->hasOne(Saller::class , 'admin_id');
    }

    public function notifications(){
        return $this->hasMany(Notification::class , 'admin_id')->where('type' , 'admins');
    }

    public function saller_notifications(){
        return $this->hasMany(Notification::class , 'saller_id')->where('type' , 'sallers');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
