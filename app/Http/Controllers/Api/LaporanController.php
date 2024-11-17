<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\LaporanService;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }
}
