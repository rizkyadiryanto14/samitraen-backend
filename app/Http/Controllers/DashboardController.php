<?php

namespace App\Http\Controllers;

use App\Models\LaporanKebakaran;
use App\Models\Unit;
use App\Models\User;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['laporanCount'] = LaporanKebakaran::count();
        $data['wilayahCount'] = Wilayah::count();
        $data['unitCount'] = Unit::count();
        $data['petugasCount'] = User::where('role', 'petugas')->count();
        $data['latestLaporan'] = LaporanKebakaran::latest()->limit(10)->get();
        return view('index')->with($data);
    }
}
