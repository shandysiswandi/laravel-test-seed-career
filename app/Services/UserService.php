<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function findByID($id)
    {
        return User::find($id);
    }

    public function listUser()
    {
        return User::all();
    }
}
