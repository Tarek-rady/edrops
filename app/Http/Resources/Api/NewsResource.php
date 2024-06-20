<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id ,
            'title'      => $this->title_ar ,
            'desc'       => $this->desc_ar ,
            'img'        => url('storage/' . $this->img) ,
            'admin'      => $this->admin->name ,
            'created_at' => date('D, d M Y - h:ia', strtotime($this->created_at)) ,
        ];
    }
}
