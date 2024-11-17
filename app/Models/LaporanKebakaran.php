<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKebakaran extends Model
{
    protected $table = 'laporan_kebakaran';
    protected $fillable = ['user_id', 'wilayah_id', 'status_laporan', 'deskripsi_laporan', 'foto_bukti'];
    public $appends = ['label_status'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAttributeLabelStatus(){
        if($this->status_laporan == 'received'){
            return 'Laporan Diterima';
        }else if($this->status_laporan == 'in_progress'){
            return 'Laporan Diproses';
        }else if($this->status_laporan == 'dispatched'){
            return 'Petugas Dikirim';
        }else if($this->status_laporan == 'completed'){
            return 'Laporan Selesai';
        }
    }
}
