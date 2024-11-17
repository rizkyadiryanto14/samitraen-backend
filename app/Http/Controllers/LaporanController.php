<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\LaporanService;

class LaporanController extends Controller
{
    protected $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }

    public function index(Request $request){
        $laporan = $this->laporanService->getLaporans()->paginate($request->per_page ?? 10);
        return view('laporan.index')->with(['laporan' => $laporan]);
    }
}
