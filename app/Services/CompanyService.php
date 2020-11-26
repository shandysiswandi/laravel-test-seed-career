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

    public function updateCompany($company, $request)
    {
        $data = [];

        if ($request->name) {
            $data['name'] = $request->name;
        }

        if ($request->address) {
            $data['address'] = $request->address;
        }

        return $company->update($data);
    }

    public function deleteCompany($company)
    {
        return $company->delete();
    }
}
