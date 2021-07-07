<?php

namespace App\Http\Resources\Mahasiswa\Alumni;

use App\Http\Resources\Biodata\BiodataResource;
use App\Http\Resources\Mahasiswa\Prodi\ProdiResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
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
            'id_number' => $this->id_number,
            'month_grad' => $this->month_grad,
            'year_grad' => $this->year_grad,
            'biodata' => new BiodataResource($this->whenLoaded('biodata')),
            'study_program' => new ProdiResource($this->whenLoaded('study_program'))
        ];
    }
}
