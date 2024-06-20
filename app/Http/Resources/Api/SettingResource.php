<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'id'         => $this->id ,
            'desc'       => $this->desc_ar ,
            'twitter'    => $this->twitter ,
            'facebook'   => $this->facebook ,
            'youtube'    => $this->youtube ,
            'instagram'  => $this->instagram ,
            'wattsapp'   => $this->wattsapp ,
            'phone'      => $this->phone ,
            'lat'        => $this->lat ,
            'lng'        => $this->lng ,
            'location'   => $this->location ,
            'email'      => $this->email ,
            'gmail'      => $this->gmail ,
        ];
    }
}
