<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function findByIDWithCompany($id)
    {
        return User::with('company')->find($id);
    }

    public function findByID($id)
    {
        return User::find($id);
    }

    public function listUserWithCompany()
    {
        return User::with('company')->get();
    }

    public function createUser($request)
    {
        return User::create([
            'company_id' => $request->company_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'account' => "" . rand(11111111, 99999999),
        ]);
    }

    public function updateUser($user, $request)
    {
        $data = [];

        if ($request->first_name) {
            $data['first_name'] = $request->first_name;
        }

        if ($request->last_name) {
            $data['last_name'] = $request->last_name;
        }

        if ($request->email) {
            $data['email'] = $request->email;
        }

        return $user->update($data);
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }
}
