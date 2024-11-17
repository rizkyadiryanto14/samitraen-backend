<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $data['role'] = 'user';
        $petugas = $this->userService->getUsers($data)->paginate($request->per_page ?? 10);
        return view('user.index')->with(['petugas' => $petugas]);
    }
}
