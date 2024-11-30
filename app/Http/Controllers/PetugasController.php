<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetugasRequest;
use App\Http\Requests\UpdatePetugasRequest;
use App\Service\UserService;
use App\Service\WilayahService;
use Exception;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    protected $userService, $wilayahService;

    public function __construct(UserService $userService, WilayahService $wilayahService)
    {
        $this->userService = $userService;
        $this->wilayahService = $wilayahService;
    }

    public function index(Request $request)
    {
        $filters['role'] = 'petugas';
        $listPetugas = $this->userService->getUsers($filters)->paginate($request->per_page ?? 10);
        return view('petugas.index')->with(['listPetugas' => $listPetugas]);
    }

    public function create()
    {
        $wilayah = $this->wilayahService->getWilayah()->get();
        return view('petugas.create')->with(['wilayah' => $wilayah]);
    }

    public function store(StorePetugasRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['role'] = 'petugas';
            $this->userService->createUser($validated);
            return redirect()->route('petugas.index')->with(['success' => 'Data berhasil ditambah']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $petugas = $this->userService->getUserByField('id', $id);
        return view('petugas.show')->with(['petugas' => $petugas]);
    }

    public function edit($id)
    {
        $wilayah = $this->wilayahService->getWilayah()->get();
        $petugas = $this->userService->getUserByField('id', $id);
        return view('petugas.edit')->with(['petugas' => $petugas, 'wilayah' => $wilayah]);
    }

    public function update(UpdatePetugasRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $user = $this->userService->getUserByField('id', $id);
            $this->userService->updateUser($user, $validated);
            return redirect()->route('petugas.index')->with(['success' => 'Data berhasil diubah']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->userService->getUserByField('id', $id);
            $this->userService->deleteUser($user);

            return redirect()->route('petugas.index')->with(['success' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
