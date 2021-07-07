<?php

namespace App\Http\Resources\Perusahaan\Data;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectTwoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $brandName = !empty($this->brand) ? ' (' . $this->brand . ')' : '';

        return [
            'id' => $this->id,
            'text' => $this->name . $brandName
        ];
    }
}
