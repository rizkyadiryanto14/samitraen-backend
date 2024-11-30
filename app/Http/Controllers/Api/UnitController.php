<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Models\Unit;
use App\Service\UnitService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    protected $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    /**
     * Get Unit
     * @group Petugas
     * @authenticated
     * @queryParam is_paginate boolean default 0
     * @queryParam per_page integer default 10
     */

    public function index(Request $request)
    {
        try {
            if ($request->has('is_paginate') && $request->is_paginate == 1) {
                $unit = $this->unitService->getUnits()->paginate($request->per_page ?? 10);
                $data = [
                    'data' => UnitResource::collection($unit),
                    'meta' => new PaginationResource($unit)
                ];
            } else {
                $unit = $this->unitService->getUnits()->get();
                $data = UnitResource::collection($unit);
            }
            return ResponseHelper::successResponse($data, 'Success Get Unit');
        } catch (\Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }
}
