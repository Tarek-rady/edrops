<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    use HasFactory;


    protected $guarded = [];

    function saller(){
        return $this->belongsTo(Saller::class , 'saller_id');
    }

    function user(){
        return $this->belongsTo(User::class , 'user_id');
    }

    public function wallet(){

        return $this->belongsTo(CountryCash::class , 'wallet_name');

    }

}
