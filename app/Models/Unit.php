<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'unit_pemadam';

    protected $fillable = [
        'id',
        'nama_unit',
        'wilayah_id',
        'status',
    ];
}
