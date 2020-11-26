<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetUserRequest;
use App\Services\UserService;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;

    public function getUser(GetUserRequest $request, UserService $userService)
    {
        $user = $userService->findByID($request->id);

        if (!$user) {
            return $this->apiError("User Not Found", 404);
        }

        return $this->apiSuccess("Success get user", [
            'id' => $user->id,
            'fullName' => "$user->first_name $user->last_name",
            'email' => $user->email,
            'account' => $user->account
        ]);
    }

    public function getListUser(UserService $userService)
    {
        $users = $userService->listUser();

        if ($users->isEmpty()) {
            return $this->apiSuccess("Success but users empty", $users);
        }

        return $this->apiSuccess("Success get users", $users->map(function ($item) {
            $res['id'] = $item->id;
            $res['fullName'] = "$item->first_name $item->last_name";
            $res['email'] = $item->email;
            $res['account'] = $item->account;

            return $res;
        }));
    }
}
