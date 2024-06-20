<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{

    public function toArray($request)
    {
        return [
             'id' => $this->id ,
             'title' => $this->title_ar ,
             'img' => url('storage/' . $this->img) ,
             'desc' => $this->desc_ar,
        ];
    }
}
