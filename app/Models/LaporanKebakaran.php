<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKebakaran extends Model
{
    protected $table = 'laporan_kebakaran';
    protected $fillable = [
        'user_id',
        'wilayah_id',
        'status_laporan',
        'deskripsi_laporan',
        'foto_bukti',
        'latitude',
        'longitude',
        'no_hp',
        'unit_id',
        'last_update_status',
        'polylines',
    ];

    protected $casts = [
        'last_update_status' => 'datetime',
        'polylines' => 'array',
    ];

    protected  $appends = ['label_status'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'wilayah_id');
    }

    public function getLabelStatusAttribute()
    {
        if ($this->status_laporan == 'received') {
            return 'Laporan Diterima';
        } else if ($this->status_laporan == 'in_progress') {
            return 'Laporan Diproses';
        } else if ($this->status_laporan == 'dispatched') {
            return 'Petugas Dikirim';
        } else if ($this->status_laporan == 'completed') {
            return 'Laporan Selesai';
        }
    }

    public function scopeFilterUser($query, $user_id)
    {
        if ($user_id) {
            return $query->where('user_id', $user_id);
        }
    }

    public function scopeFilterStatus($query, $status)
    {
        if ($status) {
            return $query->where('status_laporan', $status);
        }
    }

    public function scopeFilterWilayah($query, $wilayah_id)
    {
        if ($wilayah_id) {
            return $query->where('wilayah_id', $wilayah_id);
        }
    }

    public function scopeFilterUnit($query, $unit_id)
    {
        if ($unit_id) {
            return $query->where('unit_id', $unit_id);
        }
    }

    public function scopeFilterSearchUser($query, $search)
    {
        if ($search) {
            return $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }
    }
}
