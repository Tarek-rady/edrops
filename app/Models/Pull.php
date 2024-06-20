<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pull extends Model
{
    use HasFactory;


    protected $guarded = [];


        // function get saller
        public function saller()
        {
            return $this->belongsTo(Saller::class , 'saller_id');
        }

        // function get admin
        public function admin()
        {
            return $this->belongsTo(Admin::class , 'admin_id');
        }

        public function user(){
            return $this->belongsTo(User::class , 'user_id');
        }


}
