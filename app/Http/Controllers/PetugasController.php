<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $data['role'] = 'petugas';
        $listPetugas = $this->userService->getUsers($data)->paginate($request->per_page ?? 10);
        return view('petugas.index')->with(['listPetugas' => $listPetugas]);
    }
}
