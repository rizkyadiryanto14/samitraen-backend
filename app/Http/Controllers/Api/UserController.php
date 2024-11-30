<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePetugasRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Service\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

     /**
     * Get Profil Pelapor
     * @group Pelapor
     */
    public function getProfile()
    {
        try{
            $userId = Auth::User()->id;
            $user = $this->userService->getUserByField('id', $userId);
            $user = new UserResource($user);
            return ResponseHelper::successResponse($user, 'Success Get Profile', 200);
        }catch(Exception $e){
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }

     /**
     * Update Profil Pelapor
     * @group Pelapor
     */
    public function updateProfile(UpdateUserProfileRequest $request)
    {
        try{
            $validated = $request->validated();
            $userId = Auth::User()->id;
            $user = $this->userService->getUserByField('id', $userId);
            $data = $this->userService->updateUser($user, $validated);
            return ResponseHelper::successResponse($data, 'Success Update Profile', 200);
        }catch(Exception $e){
            return ResponseHelper::errorResponse($e->getMessage());
        }
    }
}
