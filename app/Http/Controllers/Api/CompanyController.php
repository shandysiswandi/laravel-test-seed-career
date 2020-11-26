<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\GetCompanyRequest;
use App\Services\CompanyService;
use App\Traits\ApiResponse;
use App\Traits\Logger;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ApiResponse, Logger;

    public function getCompany(GetCompanyRequest $request, CompanyService $companyService)
    {
        // log request
        $this->logRequest($request, ['id' => $request->id]);

        $company = $companyService->findByID($request->id);

        if (!$company) {
            $this->logResponse($request, 'Company Not Found');

            return $this->apiError("Company Not Found", 404);
        }

        $data = [
            'id' => $company->id,
            'name' => $company->name,
            'address' => $company->address,
        ];

        // log response
        $this->logResponse($request, $data);

        return $this->apiSuccess("Success get company", $data);
    }

    public function getListCompany(Request $request, CompanyService $companyService)
    {
        // log request
        $this->logRequest($request);

        $companies = $companyService->listCompany();

        if ($companies->isEmpty()) {
            $this->logResponse($request, 'Success but companies empty');

            return $this->apiSuccess("Success but companies empty", $companies);
        }

        $data = $companies->map(function ($item) {
            $res['id'] = $item->id;
            $res['name'] = $item->name;
            $res['address'] = $item->address;
            return $res;
        });

        // log response
        $this->logResponse($request, $data);

        return $this->apiSuccess("Success get companies", $data);
    }
}
