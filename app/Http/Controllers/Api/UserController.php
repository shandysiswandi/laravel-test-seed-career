<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetUserRequest;
use App\Services\UserService;
use App\Traits\ApiResponse;
use App\Traits\Logger;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse, Logger;

    public function getUser(GetUserRequest $request, UserService $userService)
    {
        // log request
        $this->logRequest($request, ['id' => $request->id]);

        $user = $userService->findByIDWithCompany($request->id);

        if (!$user) {
            $this->logResponse($request, "User Not Found");

            return $this->apiError("User Not Found", 404);
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

    public function getListUser(Request $request, UserService $userService)
    {
        // log request
        $this->logRequest($request);

        $users = $userService->listUserWithCompany();

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
}
