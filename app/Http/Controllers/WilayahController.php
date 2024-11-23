<?php

namespace App\Http\Controllers;

use App\Http\Requests\WilayahRequest;
use Illuminate\Http\Request;
use App\Service\WilayahService;

class WilayahController extends Controller
{
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }

    public function index(Request $request)
    {
        $listWilayah = $this->wilayahService->getWilayah()->paginate($request->per_page ?? 10);
        return view('wilayah.index')->with(['listWilayah' => $listWilayah]);
    }

    public function create()
    {
        return view('wilayah.create');
    }

    public function store(WilayahRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->wilayahService->createWilayah($validated);
            return redirect()->route('wilayah.index')->with(['success' => 'Data berhasil ditambahkan']);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $wilayah = $this->wilayahService->getWilayahByField('id', $id);
            return view('wilayah.show')->with(['wilayah' => $wilayah]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $wilayah = $this->wilayahService->getWilayahByField('id', $id);
            return view('wilayah.edit')->with(['wilayah' => $wilayah]);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(WilayahRequest $request, $id)
    {
        try {
            $wilayah = $this->wilayahService->getWilayahByField('id', $id);
            $this->wilayahService->updateWilayah($wilayah, $request->validated());
            return redirect()->route('wilayah.index');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $wilayah = $this->wilayahService->getWilayahByField('id', $id);
            $this->wilayahService->deleteWilayah($wilayah);
            return redirect()->route('wilayah.index')->with(['success' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
