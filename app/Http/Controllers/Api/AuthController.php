<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Service\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAccountRequest;
use Exception;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register
     *
     * This endpoint lets you create a user.
     * @unauthenticated
     */
    public function register(RegisterAccountRequest $request)
    {
        try {
            $validated = $request->validated();
            $user = $this->authService->register($validated);
            return ResponseHelper::successResponse($user, 'User created successfully', 201);
        } catch (Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

     /**
     * Login
     *
     * This endpoint lets you create a user.
     * @unauthenticated
     */
    public function login(LoginRequest $request)
    {
        try {
            $platform = 'mobile-app';
            $validated = $request->validated();
            $user = $this->authService->login($validated, $platform);
            return ResponseHelper::successResponse($user, 'User logged in successfully', 200);
        } catch (Exception $e) {
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }
}
