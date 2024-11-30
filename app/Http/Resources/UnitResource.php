<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_unit' => $this->nama_unit,
            'wilayah' => $this->wilayah->nama_wilayah,
            'wilayah_id' => $this->wilayah_id,
            'status' => $this->status
        ];
    }
}
