<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function findByIDWithCompany($id)
    {
        return User::with('company')->find($id);
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
}
