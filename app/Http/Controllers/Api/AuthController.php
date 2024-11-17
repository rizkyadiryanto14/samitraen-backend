<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Service\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAccountRequest;

class AuthController extends Controller
{   
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterAccountRequest $request)
    {
        $validated = $request->validated();
        $user = $this->authService->register($validated);
        return ResponseHelper::successResponse($user, 'User created successfully', 201);
    }

    public function login(LoginRequest $request)
    {
        $platform = 'mobile-app';
        $validated = $request->validated();
        $user = $this->authService->login($validated, $platform);
        return ResponseHelper::successResponse($user, 'User logged in successfully', 200);
    }
}
