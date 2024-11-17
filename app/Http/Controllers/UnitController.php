<?php

namespace App\Http\Controllers;

use App\Service\UnitService;
use Illuminate\Http\Request;

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
