<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'nama_pelapor'  => $this->user->name,
            'foto_profil'   => $this->user->foto_profil ?  asset("storage/" . $this->user->foto_profil) : asset('assets/img/avatars/blank.png'),
            'no_hp'         => $this->no_hp,
            'status_laporan' => $this->label_status,
            'deskripsi_laporan' => $this->deskripsi_laporan,
            'foto_bukti'    => asset("storage/" . $this->foto_bukti),
            'unit_id'       => $this->unit_id,
            'nama_unit'     => @$this->unit->nama_unit,
            'wilayah_id'    => $this->wilayah_id,
            'nama_wilayah'  => @$this->wilayah->nama_wilayah,
            'created_at'    => $this->created_at,
            'last_update_status' => $this->last_update_status,
            'polylines'     => !empty($this->polylines) ? json_decode($this->polylines) : [],
        ];
    }
}
