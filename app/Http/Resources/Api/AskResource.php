<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AskResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'id'     => $this->id ,
            'ask'    => $this->name_ar ,
            'answer' => $this->desc_ar ,
        ];
    }
}
