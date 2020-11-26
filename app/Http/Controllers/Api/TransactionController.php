<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trasaction\CreateCloseTransactionRequest;
use App\Http\Requests\Trasaction\CreateDisburseTransactionRequest;
use App\Http\Requests\Trasaction\CreateReimburseTransactionRequest;
use App\Services\CompanyBudgetService;
use App\Services\CompanyService;
use App\Services\TransactionService;
use App\Services\UserService;
use App\Traits\ApiResponse;
use App\Traits\Logger;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use ApiResponse, Logger;

    protected $transactionService;
    protected $userService;
    protected $companyService;
    protected $companyBudgetService;

    public function __construct(
        TransactionService $transactionService,
        UserService $userService,
        CompanyService $companyService,
        CompanyBudgetService $companyBudgetService
    ) {
        $this->transactionService = $transactionService;
        $this->userService = $userService;
        $this->companyService = $companyService;
        $this->companyBudgetService = $companyBudgetService;
    }

    public function getLogTransaction(Request $request)
    {
        $this->logRequest($request);

        $data = $this->transactionService->getLog();

        if ($data->isEmpty()) {
            $this->logResponse($request, 'Success but transaction are empty');

            return $this->apiSuccess("Success but transaction are empty", $data);
        }

        $dataMap = $data->map(function ($item) {
            $res['fullName'] = $item->first_name . " " . $item->last_name;
            $res['accountNumber'] = $item->account;
            $res['companyName'] = $item->name;
            $res['transactionType'] = $item->type;
            $res['transactionDate'] = date('d-m-Y H:i:s', strtotime($item->date));
            $res['transactionAmount'] = $item->amount;
            $res['companyBugdetAmout'] = $item->companyBugdetAmout;

            return $res;
        });

        $this->logResponse($request, $data);

        return $this->apiSuccess("Success get log transaction ", $dataMap, HttpStatus::$OK);
    }

    public function reimburse(CreateReimburseTransactionRequest $request)
    {
        $user = $this->userService->findById($request->user_id);
        if (!$user) {
            $this->logResponse($request, "User ID given not found");

            return $this->apiError("User ID given not found", HttpStatus::$NOT_FOUND);
        }

        $company = $this->companyService->findById($user->company_id);
        if (!$company) {
            $this->logResponse($request, "Companynot found");

            return $this->apiError("Companynot found", HttpStatus::$NOT_FOUND);
        }

        $companyBudget = $this->companyBudgetService->findByCompanyId($company->id);
        if (!$companyBudget) {
            $this->logResponse($request, "Company Budget not found");

            return $this->apiError("Company Budget not found", HttpStatus::$NOT_FOUND);
        }

        $value = $companyBudget->amount - $request->amount;
        if ($value < 0) {
            $this->logResponse($request, "Company Budget not enough");

            return $this->apiError("Company Budget not enough", HttpStatus::$NOT_FOUND);
        }

        $transaction = $this->transactionService->reimburse($companyBudget, $value, $request);
        return $this->_funcRepeat($request, $transaction, $user, 'reimburse');
    }

    public function disburse(CreateDisburseTransactionRequest $request)
    {
        $user = $this->userService->findById($request->user_id);
        if (!$user) {
            $this->logResponse($request, "User ID given not found");

            return $this->apiError("User ID given not found", HttpStatus::$NOT_FOUND);
        }

        $company = $this->companyService->findById($user->company_id);
        if (!$company) {
            $this->logResponse($request, "Companynot found");

            return $this->apiError("Companynot found", HttpStatus::$NOT_FOUND);
        }

        $companyBudget = $this->companyBudgetService->findByCompanyId($company->id);
        if (!$companyBudget) {
            $this->logResponse($request, "Company Budget not found");

            return $this->apiError("Company Budget not found", HttpStatus::$NOT_FOUND);
        }

        $value = $companyBudget->amount - $request->amount;
        if ($value < 0) {
            $this->logResponse($request, "Company Budget not enough");

            return $this->apiError("Company Budget not enough", HttpStatus::$NOT_FOUND);
        }

        $transaction = $this->transactionService->disburse($companyBudget, $value, $request);
        return $this->_funcRepeat($request, $transaction, $user, 'disburse');
    }

    public function close(CreateCloseTransactionRequest $request)
    {
        $user = $this->userService->findById($request->user_id);
        if (!$user) {
            $this->logResponse($request, "User ID given not found");

            return $this->apiError("User ID given not found", HttpStatus::$NOT_FOUND);
        }

        $company = $this->companyService->findById($user->company_id);
        if (!$company) {
            $this->logResponse($request, "Companynot found");

            return $this->apiError("Companynot found", HttpStatus::$NOT_FOUND);
        }

        $companyBudget = $this->companyBudgetService->findByCompanyId($company->id);
        if (!$companyBudget) {
            $this->logResponse($request, "Company Budget not found");

            return $this->apiError("Company Budget not found", HttpStatus::$NOT_FOUND);
        }

        $value = $companyBudget->amount + $request->amount;

        $transaction = $this->transactionService->close($companyBudget, $value, $request);
        return $this->_funcRepeat($request, $transaction, $user, 'close');
    }

    private function _funcRepeat($request, $service, $user, $type = 'reimburse')
    {
        // log request
        $this->logRequest($request);

        // fun

        $transaction = $service;
        if (!$transaction) {
            $this->logResponse($request, "Failed create transaction " . $type);

            return $this->apiError("Failed create transaction " . $type, HttpStatus::$BAD_REQUEST);
        }

        // log response
        $data = [
            'id' => $transaction->id,
            'userEmail' => $user->email,
            'userAccountNumber' => $user->account,
            'amount' => $transaction->amount,
        ];

        $this->logResponse($request, $data);

        return $this->apiSuccess("Success create transaction " . $type, $data, HttpStatus::$CREATED);
    }
}
