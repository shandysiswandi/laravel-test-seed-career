<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\GetCompanyRequest;
use App\Services\CompanyService;
use App\Traits\ApiResponse;

class CompanyController extends Controller
{
    use ApiResponse;

    public function getCompany(GetCompanyRequest $request, CompanyService $companyService)
    {
        $company = $companyService->findByID($request->id);

        if (!$company) {
            return $this->apiError("Company Not Found", 404);
        }

        return $this->apiSuccess("Success get company", [
            'id' => $company->id,
            'name' => $company->name,
            'address' => $company->address,
        ]);
    }

    public function getListCompany(CompanyService $companyService)
    {
        $companies = $companyService->listCompany();

        if ($companies->isEmpty()) {
            return $this->apiSuccess("Success but companies empty", $companies);
        }

        return $this->apiSuccess("Success get companies", $companies->map(function ($item) {
            $res['id'] = $item->id;
            $res['name'] = $item->name;
            $res['address'] = $item->address;
            return $res;
        }));
    }
}
