<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Service\LaporanService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\LaporanResource;
use App\Http\Requests\StoreLaporanRequest;
use App\Http\Resources\PaginationResource;
use App\Http\Requests\UpdateLaporanRequest;
use App\Http\Resources\LaporanDetailResource;
use App\Http\Requests\UpdateStatusLaporanRequest;

class LaporanController extends Controller
{
    protected $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }

    /**
     * Get Riwayat Laporan
     * @group Petugas
     * @queryParam is_paginate boolean default 0
     * @queryParam per_page integer default 10
     * @queryParam status string default received
     * @queryParam wilayah_id integer default null
     * @queryParam unit_id integer default null
     * @queryParam search string default null
     */
    public function getRiwayat(Request $request)
    {
        try {
            $filters = $request->only('status', 'wilayah_id', 'unit_id', 'search');
            $laporan = $this->laporanService->getLaporans($filters);
            if ($request->has('is_paginate') && $request->is_paginate == 1) {
                $laporan = $laporan->paginate($request->per_page ?? 10);
                $data = [
                    'data' => LaporanResource::collection($laporan),
                    'meta' => new PaginationResource($laporan)
                ];
            } else {
                $data = LaporanResource::collection($laporan->get());
            }
            return ResponseHelper::successResponse($data, 'Success Get Riwayat Laporan');
        } catch (Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

     /**
     * Get Laporan Terbaru
     * @group Petugas
     */
    public function getLaporanTerbaru()
    {
        try {
            $laporan = $this->laporanService->getLaporans()->limit(10)->get();
            $data = LaporanResource::collection($laporan);
            return ResponseHelper::successResponse($data, 'Success Get Laporan Terbaru');
        } catch (Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

    /**
     * Get Riwayat Laporan
     * @group Pelapor
     * @queryParam is_paginate boolean default 0
     * @queryParam per_page integer default 10
     */
    public function getRiwayatByPelapor(Request $request)
    {
        try {
            $filters['user_id'] = Auth::User()->id;
            $filters['status'] = $request->status ?? null;
            $laporan = $this->laporanService->getLaporans($filters);
            if ($request->has('is_paginate') && $request->is_paginate == 1) {
                $laporan = $laporan->paginate($request->per_page ?? 10);
                $data = [
                    'data' => LaporanResource::collection($laporan),
                    'meta' => new PaginationResource($laporan)
                ];
            } else {
                $data = LaporanResource::collection($laporan->get());
            }
            return ResponseHelper::successResponse($data, 'Success Get Riwayat Laporan');
        } catch (Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

    /**
     * Create Laporan
     * @group Pelapor
     */
    public function store(StoreLaporanRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            if (Wilayah::count() <= 0) { //jika belum ada data pemadam maka throw error
                throw new Exception("Tidak bisa membuat laporan, sistem belum memiliki data wilayah pemadam");
            }
            $validated['user_id'] = Auth::user()->id;
            $validated['status'] = 'received';
            $laporan = $this->laporanService->createLaporan($validated);
            DB::commit();
            return ResponseHelper::successResponse($laporan, 'Success Create Laporan');
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

    /**
     * Get Detail Laporan
     * @group Petugas
     * @urlParam id_laporan required The ID of the Laporan. Example: 1
     */
    public function show($id_laporan)
    {
        try {
            $laporan = $this->laporanService->getLaporanByField('id', $id_laporan);
            $laporan->load('wilayah', 'user', 'unit');
            $laporan = new LaporanDetailResource($laporan);
            return ResponseHelper::successResponse($laporan, 'Success Get Laporan');
        } catch (Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

    /**
     * Get Detail Laporan
     * @group Pelapor
     * @urlParam id_laporan required The ID of the Laporan. Example: 1
     */
    public function showLaporanUser($id_laporan)
    {
        try {
            $laporan = $this->laporanService->getLaporanByField('id', $id_laporan);
            if ($laporan->user_id != Auth::user()->id) {
                throw new Exception("Unauthorized");
            }
            $laporan->load('wilayah', 'user', 'unit');
            $laporan = new LaporanDetailResource($laporan);
            return ResponseHelper::successResponse($laporan, 'Success Get Laporan');
        } catch (Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

    /**
     * Update Laporan
     * @group Petugas
     * @urlParam id_laporan required The ID of the Laporan. Example: 1
     */
    public function update($id_laporan, UpdateLaporanRequest $request){
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $laporan = $this->laporanService->getLaporanByField('id', $id_laporan);
            $laporan = $this->laporanService->updateStatusLaporan($laporan, $validated);
            DB::commit();
            return ResponseHelper::successResponse($laporan, 'Success Update Status Laporan');
        } catch (Exception $e) {
            DB::rollBack();
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }
}
