<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleStock extends Model
{
    use HasFactory;


    protected $guarded = [];

    public function role() {

        return $this->belongsTo(Role::class , 'role_id');
    }


    public function stock() {

        return $this->belongsTo(Stock::class , 'stock_id');
    }

}
