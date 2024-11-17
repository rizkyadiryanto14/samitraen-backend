<?php

namespace App\Service;

use App\Models\User;

class UserService
{
    public function getUsers(array $data = [])
    {
        $users = User::filterRole(@$data['role'])->orderBy('id', 'desc');
        return $users;
    }
}
