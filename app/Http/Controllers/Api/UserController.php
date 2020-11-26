<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\GetUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\CompanyService;
use App\Services\UserService;
use App\Traits\ApiResponse;
use App\Traits\Logger;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse, Logger;

    protected $userService;
    protected $companyService;

    public function __construct(UserService $userService, CompanyService $companyService)
    {
        $this->userService = $userService;
        $this->companyService = $companyService;
    }

    public function getUser(GetUserRequest $request)
    {
        // log request
        $this->logRequest($request, ['id' => $request->id]);

        $user = $this->userService->findByIDWithCompany($request->id);

        if (!$user) {
            $this->logResponse($request, "User Not Found");

            return $this->apiError("User Not Found", HttpStatus::$NOT_FOUND);
        }

        $data = [
            'id' => $user->id,
            'company' => $user->company->name,
            'fullName' => "$user->first_name $user->last_name",
            'email' => $user->email,
            'account' => $user->account
        ];

        // log response
        $this->logResponse($request, $data);

        return $this->apiSuccess("Success get user", $data);
    }

    public function getListUser(Request $request)
    {
        // log request
        $this->logRequest($request);

        $users = $this->userService->listUserWithCompany();

        if ($users->isEmpty()) {
            $this->logResponse($request, "Success but users empty");

            return $this->apiSuccess("Success but users empty", $users);
        }

        $data = $users->map(function ($item) {
            $res['id'] = $item->id;
            $res['company'] = $item->company->name;
            $res['fullName'] = "$item->first_name $item->last_name";
            $res['email'] = $item->email;
            $res['account'] = $item->account;

            return $res;
        });

        // log response
        $this->logResponse($request, $data);

        return $this->apiSuccess("Success get users", $data);
    }

    public function createUser(CreateUserRequest $request)
    {
        // log request
        $this->logRequest($request);

        $company = $this->companyService->findById($request->company_id);
        if (!$company) {
            $this->logResponse($request, "Company ID given not found");

            return $this->apiError("Company ID given not found", HttpStatus::$NOT_FOUND);
        }

        $user = $this->userService->createUser($request);
        if (!$user) {
            $this->logResponse($request, "Failed create user");

            return $this->apiError("Failed create user", HttpStatus::$BAD_REQUEST);
        }

        // log response
        $data = [
            'id' => $user->id,
            'company' => $company->name,
            'fullName' => "$user->first_name $user->last_name",
            'email' => $user->email,
            'account' => $user->account,
        ];

        $this->logResponse($request, $data);

        return $this->apiSuccess("Success create user", $data, HttpStatus::$CREATED);
    }

    public function updateUser(UpdateUserRequest $request)
    {
        // log request
        $this->logRequest($request);

        $user = $this->userService->findByIDWithCompany($request->id);
        if (!$user) {
            $this->logResponse($request, "User not found");

            return $this->apiError("User not found", HttpStatus::$NOT_FOUND);
        }

        $userUpdate = $this->userService->updateUser($user, $request);
        if (!$userUpdate) {
            $this->logResponse($request, "Failed update user");

            return $this->apiError("Failed update user", HttpStatus::$BAD_REQUEST);
        }

        $fName = $request->first_name ?: $user->first_name;
        $lName = $request->last_name ?: $user->last_name;
        $email = $request->email ?: $user->email;

        $data = [
            'id' => $user->id,
            'company' => $user->company->name,
            'fullName' => "$fName $lName",
            'email' => $email,
            'account' => $user->account,
        ];

        $this->logResponse($request, $data);

        return $this->apiSuccess("Success update user", $data, HttpStatus::$OK);
    }
}
