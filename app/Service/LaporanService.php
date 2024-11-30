<?php

namespace App\Service;

use Exception;
use App\Models\Wilayah;
use App\Models\LaporanKebakaran;
use App\Models\LogStatusLaporan;
use App\Service\OpenRouteService;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LaporanService
{
    public function getLaporans(array $filters = [])
    {
        $laporan = LaporanKebakaran::with('wilayah', 'user', 'unit')
            ->filterWilayah(@$filters['wilayah_id'])
            ->filterUnit(@$filters['unit_id'])
            ->filterSearchUser(@$filters['search'])
            ->filterStatus(@$filters['status'])
            ->filterUser(@$filters['user_id'])
            ->orderBy('id', 'desc');
        return $laporan;
    }

    public function getLaporanByField($field, $value)
    {
        $laporan = LaporanKebakaran::where($field, $value)->first();
        if (!$laporan) {
            throw new Exception('laporan not found');
        }
        return $laporan;
    }

    public function createLaporan(array $data)
    {
        if (@$data['foto_bukti']) {
            $data['foto_bukti'] = $data['foto_bukti']->store('foto_bukti', 'public');
        }

        //cari wilayah terdekat
        $selectedWilayah = null;
        $distance = null;
        foreach (Wilayah::all() as $wilayah) {
            $check_distance = $this->checkDistance($wilayah->latitude, $wilayah->longitude, $data['latitude'], $data['longitude']);
            if ($distance === null || $check_distance < $distance) {
                $distance = $check_distance;
                $selectedWilayah = $wilayah;
            }
        }

        //get polylines
        $openRouteService = new OpenRouteService();
        $start = [
            'lat' => $selectedWilayah->latitude,
            'lng' => $selectedWilayah->longitude,
        ];
        $end = [
            'lat' => $data['latitude'],
            'lng' => $data['longitude'],
        ];
        $polylines = $openRouteService->getRoutePolyline($start, $end);
        $data['polylines'] = json_encode($polylines);

        $data['last_update_status'] = now();
        $data['wilayah_id'] = $selectedWilayah->id;
        $laporan = LaporanKebakaran::create($data);
        LogStatusLaporan::create(['laporan_id' => $laporan->id, 'status_laporan' => 'received', 'updated_by' => FacadesAuth::User()->id]);
    }

    public function checkDistance($dest_lat, $dest_long, $source_lat, $source_long)
    {
        $theta = $dest_long - $source_long;
        $distance = (sin(deg2rad($dest_lat)) *
            sin(deg2rad($source_lat))) + (cos(deg2rad($dest_lat)) *
            cos(deg2rad($source_lat)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        $distance = round($distance * 1.609344, 4);

        return $distance;
    }

    public function updateStatusLaporan($laporan, array $data)
    {
        if (!empty(@$data['status'])) {
            if ($data['status'] == $laporan->status_laporan) {
                throw new Exception("Status laporan belum berubah");
            }
            $laporan->status_laporan = $data['status'];
            $laporan->last_update_status = now();
            LogStatusLaporan::create(['laporan_id' => $laporan->id, 'status_laporan' => $data['status'], 'updated_by' => FacadesAuth::User()->id]);
        }

        if (!empty(@$data['unit_id'])) {
            $laporan->unit_id = $data['unit_id'];
        }

        $laporan->save();
        return $laporan;
    }
}
