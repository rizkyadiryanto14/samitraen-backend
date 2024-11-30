<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;
use App\Service\WilayahService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Exception;

class UserController extends Controller
{
    protected $userService, $wilayahService;

    public function __construct(UserService $userService, WilayahService $wilayahService)
    {
        $this->userService = $userService;
        $this->wilayahService = $wilayahService;
    }

    public function index(Request $request)
    {
        $filters['role'] = 'user';
        $listUser = $this->userService->getUsers($filters)->paginate($request->per_page ?? 10);
        return view('user.index')->with(['listUser' => $listUser]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['role'] = 'user';
            $this->userService->createUser($validated);
            return redirect()->route('user.index')->with(['success' => 'Data berhasil ditambah']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $user = $this->userService->getUserByField('id', $id);
        return view('user.show')->with(['user' => $user]);
    }

    public function edit($id)
    {
        $user = $this->userService->getUserByField('id', $id);
        return view('user.edit')->with(['user' => $user]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $user = $this->userService->getUserByField('id', $id);
            $this->userService->updateUser($user, $validated);
            return redirect()->route('user.index')->with(['success' => 'Data berhasil diubah']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = $this->userService->getUserByField('id', $id);
            $this->userService->deleteUser($user);

            return redirect()->route('user.index')->with(['success' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
