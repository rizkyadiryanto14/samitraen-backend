<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\WilayahService;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }

    public function index(Request $request)
    {
        $wilayah = $this->wilayahService->getWilayah()->paginate($request->per_page ?? 10);
        return view('wilayah.index')->with(['wilayah' => $wilayah]);
    }
}
