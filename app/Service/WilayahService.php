<?php

namespace App\Service;

use App\Models\Wilayah;

class WilayahService
{
    public function getWilayah(array $data = []){
        $wilayah = Wilayah::orderBy('id','desc');
        return $wilayah;
    }
}