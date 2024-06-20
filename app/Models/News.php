<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;


    protected $guarded = [];

    // get Title translation
    public function getTitleAttribute()
    {
        return $this->attributes['title_' . app()->getLocale()];
    } // end getTitleAttribute


      // get Desc translation
      public function getDescAttribute()
      {
          return $this->attributes['desc_' . app()->getLocale()];
      } // end getDescAttribute


    public function admin(){
        return $this->belongsTo(Admin::class , 'admin_id');
    }

}
