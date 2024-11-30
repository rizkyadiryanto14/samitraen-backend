<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePetugasRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserResource;
use App\Service\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;

/**
 * @group Petugas
 * @authenticated
 */
class PetugasController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Get Petugas Profile
     * 
     * Get the profile of the authenticated user
     * 
     * @authenticated 
     * 
     * @return \Illuminate\Http\JsonResponse
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
     * Update Petugas Profile
     * 
     * Update the profile of the authenticated user
     * 
     * @authenticated
     * 
     * @param \App\Http\Requests\UpdatePetugasRequest $request
     * @return \Illuminate\Http\JsonResponse
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
