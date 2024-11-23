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
        $filters['role'] = 'petugas';
        $listPetugas = $this->userService->getUsers($filters)->paginate($request->per_page ?? 10);
        return view('petugas.index')->with(['listPetugas' => $listPetugas]);
    }

    public function create()
    {
        return view('petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $this->userService->createUser(array_merge($request->all(), ['role' => 'petugas']));

        return redirect()->route('petugas.index');
    }

    public function show($id)
    {
        $petugas = $this->userService->getUserById($id);

        return view('petugas.show')->with(['petugas' => $petugas]);
    }

    public function edit($id)
    {
        $petugas = $this->userService->getUserById($id);

        return view('petugas.edit')->with(['petugas' => $petugas]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $this->userService->updateUser($id, $request->all());

        return redirect()->route('petugas.index');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return redirect()->route('petugas.index');
    }
}
