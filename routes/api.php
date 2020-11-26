<?php

use App\Http\Controllers\Api\CompanyBudgetController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['force.json']], function () {
    // user
    Route::post('getUser', [UserController::class, 'getUser']);
    Route::post('getListUser', [UserController::class, 'getListUser']);
    Route::post('createUser', [UserController::class, 'createUser']);

    // company
    Route::post('getCompany', [CompanyController::class, 'getCompany']);
    Route::post('getListCompany', [CompanyController::class, 'getListCompany']);
    Route::post('createCompany', [CompanyController::class, 'createCompany']);

    // company budget
    Route::post('getCompanyBudget', [CompanyBudgetController::class, 'getCompanyBudget']);
    Route::post('getListCompanyBudget', [CompanyBudgetController::class, 'getListCompanyBudget']);
});
