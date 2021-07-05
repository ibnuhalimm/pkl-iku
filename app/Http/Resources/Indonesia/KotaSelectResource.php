<?php

namespace App\Http\Resources\Indonesia;

use Illuminate\Http\Resources\Json\JsonResource;

class KotaSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'text' => $this->name
        ];
    }
}
