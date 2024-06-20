<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{

    public function toArray($request)
    {
        return [
             'id' => $this->id ,
             'title' => $this->title_ar ,
             'desc' => $this->desc_ar ,
             'link' => $this->link ,
             'img' => url('storage/'.$this->img) ,
        ];
    }
}
