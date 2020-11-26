<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyBudget\GetCompanyBudgetRequest;
use App\Services\CompanyBudgetService;
use App\Traits\ApiResponse;
use App\Traits\Logger;
use Illuminate\Http\Request;

class CompanyBudgetController extends Controller
{
    use ApiResponse, Logger;

    public function getCompanyBudget(GetCompanyBudgetRequest $request, CompanyBudgetService $companyBudgetService)
    {
        // log request
        $this->logRequest($request, ['id' => $request->id]);

        $companyBudget = $companyBudgetService->findByIDWithCompany($request->id);

        if (!$companyBudget) {
            $this->logResponse($request, 'Company Budget Not Found');

            return $this->apiError("Company Budget Not Found", 404);
        }

        $data = [
            'id' => $companyBudget->id,
            'company' => $companyBudget->company->name,
            'amount' => $companyBudget->amount
        ];

        // log response
        $this->logResponse($request, $data);

        return $this->apiSuccess("Success get company budget", $data);
    }

    public function getListCompanyBudget(Request $request, CompanyBudgetService $companyBudgetService)
    {
        // log request
        $this->logRequest($request);

        $companyBudgets = $companyBudgetService->listCompanyBudgetWithCompany();

        if ($companyBudgets->isEmpty()) {
            $this->logResponse($request, 'Success but company budgets empty');

            return $this->apiSuccess("Success but company budgets empty", $companyBudgets);
        }

        $data = $companyBudgets->map(function ($item) {
            $res['id'] = $item->id;
            $res['company'] = $item->company->name;
            $res['amount'] = $item->amount;

            return $res;
        });

        // log response
        $this->logResponse($request, $data);

        return $this->apiSuccess("Success get company budgets", $data);
    }
}
