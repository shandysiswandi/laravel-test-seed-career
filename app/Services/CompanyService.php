<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function findByID($id)
    {
        return Company::find($id);
    }

    public function listCompany()
    {
        return Company::all();
    }

    public function createCompany($request)
    {
        return Company::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);
    }
}
