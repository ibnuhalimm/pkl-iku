<?php

namespace App\Http\Resources\Mahasiswa\Alumni;

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
        return [
            'id' => $this->id,
            'text' => $this->id_number . ' - ' . $this->student_name
        ];
    }
}
