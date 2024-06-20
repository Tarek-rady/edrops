<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NumberResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'id'      => $this->id ,
            'title'    => $this->title_ar ,
            'img'     => url('storage/' . $this->img) ,
            'number'  => $this->desc_ar ,
        ];
    }
}
