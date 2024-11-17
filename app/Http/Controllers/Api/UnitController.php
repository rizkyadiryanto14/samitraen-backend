<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use App\Service\UnitService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    protected $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function index(Request $request)
    {
        $unit = $this->unitService->getUnits()->paginate($request->per_page ?? 10);
        return view('unit.index')->with(['unit' => $unit]);
    }
}
