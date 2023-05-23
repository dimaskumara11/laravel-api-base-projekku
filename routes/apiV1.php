<?php

use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\MediaController;
use Illuminate\Support\Facades\Route;

Route::middleware('my-auth-api')->group(function () {
    Route::prefix("company")->group(function () {
        Route::get("/", [CompanyController::class, 'get']);
        Route::get("/{id}", [CompanyController::class, 'detail']);
        Route::post("/", [CompanyController::class, 'create']);
        Route::put("/{id}", [CompanyController::class, 'update']);
        Route::delete("/{id}", [CompanyController::class, 'delete']);
    });
    Route::prefix("media")->group(function () {
        Route::post("/", [MediaController::class, 'uploadFile']);
    });
});