<?php

namespace App\Service;

use App\Models\Wilayah;
use Exception;

class WilayahService
{
    public function getWilayah(array $data = []){
        $wilayah = Wilayah::with('units', 'laporan_kebakaran')->orderBy('id','desc');
        return $wilayah;
    }

    public function getWilayahByField($field, $value){
        $wilayah = Wilayah::where($field, $value)->first();
        if($wilayah){
            return $wilayah;
        }
        throw new Exception('Wilayah not found');
    }

    public function createWilayah(array $data){
        $wilayah = Wilayah::create($data);
        return $wilayah;
    }

    public function updateWilayah(Wilayah $wilayah, array $data){
        $wilayah->update($data);
        return $wilayah;
    }

    public function deleteWilayah(Wilayah $wilayah){
        if($wilayah->units->count() > 0 || $wilayah->laporan_kebakaran->count() > 0){
            throw new Exception('Wilayah sedang digunakan, tidak dapat dihapus');
        }

        $wilayah->delete();
    }
}