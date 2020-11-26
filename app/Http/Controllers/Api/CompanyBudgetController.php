<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyBudget\GetCompanyBudgetRequest;
use App\Services\CompanyBudgetService;
use App\Traits\ApiResponse;

class CompanyBudgetController extends Controller
{
    use ApiResponse;

    public function getCompanyBudget(GetCompanyBudgetRequest $request, CompanyBudgetService $companyBudgetService)
    {
        $companyBudget = $companyBudgetService->findByID($request->id);

        if (!$companyBudget) {
            return $this->apiError("Company Budget Not Found", 404);
        }

        return $this->apiSuccess("Success get company budget", $companyBudget);
    }

    public function getListCompanyBudget(CompanyBudgetService $companyBudgetService)
    {
        $companyBudgets = $companyBudgetService->listCompanyBudget();

        if ($companyBudgets->isEmpty()) {
            return $this->apiSuccess("Success but company budgets empty", $companyBudgets);
        }

        return $this->apiSuccess("Success get company budgets", $companyBudgets);
    }
}
