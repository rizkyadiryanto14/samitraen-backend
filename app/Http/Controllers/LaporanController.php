<?php

namespace App\Http\Controllers;

use App\Http\Resources\LaporanResource;
use Illuminate\Http\Request;
use App\Service\LaporanService;
use Exception;

class LaporanController extends Controller
{
    protected $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }

    public function index(Request $request){
        $laporan = $this->laporanService->getLaporans()->paginate($request->per_page ?? 10);
        return view('laporan.index')->with(['listLaporan' => $laporan]);
    }

    public function show($id){
        try{
            $laporan = $this->laporanService->getLaporanByField('id',$id);
            $laporan->load('wilayah', 'user', 'unit');
            return view('laporan.show')->with(['laporan' => $laporan]);
        }catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        
    }
}
