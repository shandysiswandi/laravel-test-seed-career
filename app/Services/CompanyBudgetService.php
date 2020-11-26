<?php

namespace App\Services;

use App\Models\CompanyBudget;

class CompanyBudgetService
{
    public function findByID($id)
    {
        return CompanyBudget::find($id);
    }

    public function listCompanyBudget()
    {
        return CompanyBudget::all();
    }
}
