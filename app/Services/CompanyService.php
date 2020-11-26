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
}
