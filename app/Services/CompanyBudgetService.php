<?php

namespace App\Services;

use App\Models\CompanyBudget;

class CompanyBudgetService
{
    public function findByIDWithCompany($id)
    {
        return CompanyBudget::with('company')->find($id);
    }

    public function findByCompanyId($company_id)
    {
        return CompanyBudget::where('company_id', $company_id)->first();
    }

    public function listCompanyBudgetWithCompany()
    {
        return CompanyBudget::with('company')->get();
    }
}
