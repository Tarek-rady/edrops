<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{

    public function toArray($request)
    {
        return [
             'id'       => $this->id ,
             'user'     => $this->user_name ,
             'country'  => $this->country->name_ar ,
             'img'      => url('storage/' . $this->country->img) ,
             'msg'      => $this->msg ,
        ];
    }
}
