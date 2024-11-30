<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WilayahResource extends JsonResource
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
            'nama_wilayah' => $this->nama_wilayah,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'jumlah_unit' => $this->units->count(),
            'jumlah_pelaporan' => $this->laporan_kebakaran->count(),
        ];
    }
}
