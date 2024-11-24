<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Service\UnitService;
use App\Service\WilayahService;
use Exception;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    protected $unitService, $wilayahService;

    public function __construct(UnitService $unitService, WilayahService $wilayahService)
    {
        $this->unitService = $unitService;
        $this->wilayahService = $wilayahService;
    }

    public function index(Request $request)
    {
        $listUnit = $this->unitService->getUnits()->paginate($request->per_page ?? 10);
        return view('unit.index')->with(['listUnit' => $listUnit]);
    }

    //TODO create resource function except index
    public function create()
    {
        $wilayah = $this->wilayahService->getWilayah()->get();
        return view('unit.create')->with(['wilayah' => $wilayah]);
    }

    public function store(UnitRequest $request)
    {
        try {
            $this->unitService->createUnit($request->validated());
            return redirect()->route('unit.index')->with(['success' => 'Data berhasil ditambahkan']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $unit = $this->unitService->getUnitByField('id', $id);
        return view('unit.show')->with(['unit' => $unit]);
    }

    public function edit($id)
    {
        try {
            $unit = $this->unitService->getUnitByField('id', $id);
            $wilayah = $this->wilayahService->getWilayah()->get();
            return view('unit.edit')->with(['unit' => $unit, 'wilayah' => $wilayah]);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(UnitRequest $request, $id)
    {
        try {
            $unit = $this->unitService->getUnitByField('id', $id);
            $this->unitService->updateUnit($unit, $request->validated());
            return redirect()->route('unit.index')->with(['success' => 'Data berhasil diubah']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $unit = $this->unitService->getUnitByField('id', $id);
            $this->unitService->deleteUnit($unit);
            return redirect()->route('unit.index')->with(['success' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
