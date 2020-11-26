<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\GetCompanyRequest;
use App\Services\CompanyService;
use App\Traits\ApiResponse;
use App\Traits\Logger;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ApiResponse, Logger;

    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function getCompany(GetCompanyRequest $request)
    {
        // log request
        $this->logRequest($request, ['id' => $request->id]);

        $company = $this->companyService->findByID($request->id);

        if (!$company) {
            $this->logResponse($request, 'Company Not Found');

            return $this->apiError("Company Not Found", HttpStatus::$NOT_FOUND);
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

    public function getListCompany(Request $request)
    {
        // log request
        $this->logRequest($request);

        $companies = $this->companyService->listCompany();

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

    public function createCompany(CreateCompanyRequest $request)
    {
        // log request
        $this->logRequest($request);

        $company = $this->companyService->createCompany($request);
        if (!$company) {
            $this->logResponse($request, "Failed create company");

            return $this->apiError("Failed create company", HttpStatus::$BAD_REQUEST);
        }

        // log response
        $data = [
            'id' => $company->id,
            'name' => $company->name,
            'address' => $company->address
        ];
        $this->logResponse($request, $data);

        return $this->apiSuccess("Success create company", $data, HttpStatus::$CREATED);
    }
}
