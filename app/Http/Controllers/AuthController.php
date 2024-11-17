<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Service\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    /**
     * AuthController constructor.
     *
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function loginView(){
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        try{
            $validated = $request->validated();
            $platform = 'web-dashboard';
            $this->authService->login($validated, $platform);
            return redirect()->route('/');
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login-view');
    }
}
