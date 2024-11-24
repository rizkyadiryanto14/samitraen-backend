<?php

namespace App\Service;

use App\Models\User;
use Exception;

class UserService
{
    public function getUsers(array $filters = [])
    {
        $users = User::with('wilayah')->filterRole(@$filters['role'])->orderBy('id', 'desc');
        return $users;
    }

    public function getUserByField($field, $value){
        $user = User::where($field, $value)->first();
        if(empty($user)){
            throw new Exception('User Not Found');
        }

        return $user;
    }

    public function createUser(array $data = [])
    {
        $user = User::create($data);
        return $user;
    }

    public function deleteUser(User $user)
    {
       $user->delete();
    }

    public function updateUser(User $user, array $data = [])
    {
        $user->update($data);
        return $user;
    }

}
