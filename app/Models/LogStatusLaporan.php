<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogStatusLaporan extends Model
{
    protected $table = 'log_status_laporan';

    protected $fillable = [
        'laporan_id',
        'status_laporan',
        'updated_by',
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanKebakaran::class, 'laporan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
