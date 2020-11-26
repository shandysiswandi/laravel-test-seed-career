<?php

namespace App\Services;

use App\Models\CompanyBudget;

class CompanyBudgetService
{
    public function findByIDWithCompany($id)
    {
        return CompanyBudget::with('company')->find($id);
    }

    public function listCompanyBudgetWithCompany()
    {
        return CompanyBudget::with('company')->get();
    }
}
