<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\WilayahResource;
use App\Models\Wilayah;
use App\Service\WilayahService;
use Illuminate\Http\Request;


class WilayahController extends Controller
{
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }

    /**
     * Get Wilayah
     * @group Petugas
     * @authenticated
     * @queryParam is_paginate boolean default 0
     * @queryParam per_page integer default 10
     * 
     */    public function index(Request $request)
    {
        try {
            if ($request->has('is_paginate') && $request->is_paginate == 1) {
                $wilayah = $this->wilayahService->getWilayah()->paginate($request->per_page ?? 10);
                $data = [
                    'data' => WilayahResource::collection($wilayah),
                    'meta' => new PaginationResource($wilayah)
                ];
            } else {
                $wilayah = $this->wilayahService->getWilayah()->get();
                $data = WilayahResource::collection($wilayah);
            }
            
            return ResponseHelper::successResponse($data, 'Success Get Wilayah');
        } catch (\Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }
}
