<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table ='wilayah';
    protected $fillable = ['id', 'nama_wilayah', 'latitude', 'longitude'];

    public function units(){
        return $this->hasMany(Unit::class);
    }

    public function laporan_kebakaran(){
        return $this->hasMany(LaporanKebakaran::class);
    }
}
