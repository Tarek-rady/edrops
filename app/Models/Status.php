<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;


    protected $guarded = [];

    // get Name translation
    public function getNameAttribute()
    {
        return $this->attributes['name_' . app()->getLocale()];
    } // end getNameAttribute

}
