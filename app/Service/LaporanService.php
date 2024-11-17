<?php

namespace App\Service;

use App\Models\LaporanKebakaran;

class LaporanService
{
    public function getLaporans(array $data = []){
        $laporan = LaporanKebakaran::orderBy('id', 'desc');
        return $laporan;
    }
}