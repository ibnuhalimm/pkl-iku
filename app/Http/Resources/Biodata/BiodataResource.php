<?php

namespace App\Http\Resources\Biodata;

use Illuminate\Http\Resources\Json\JsonResource;

class BiodataResource extends JsonResource
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
            'id_card_number' => $this->id_card_number,
            'name' => $this->name
        ];
    }
}
