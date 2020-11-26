<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function findByIDWithCompany($id)
    {
        return User::with('company')->find($id);
    }

    public function listUserWithCompany()
    {
        return User::with('company')->get();
    }
}
