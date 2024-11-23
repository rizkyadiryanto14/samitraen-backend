<?php

namespace App\Service;

use App\Models\User;

class UserService
{
    public function getUsers(array $filters = [])
    {
        $users = User::with('wilayah')->filterRole(@$filters['role'])->orderBy('id', 'desc');
        return $users;
    }
}
