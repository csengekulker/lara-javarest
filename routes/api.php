<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::group(["middleware" => ["auth:sanctum"]], function () {
    Route::post("new-product", [ProductController::class, 'create']);
    Route::put("products/{id}", [ProductController::class, 'update']);
    Route::delete("products/{id}", [ProductController::class, 'destroy']);

    Route::post("logout", [AuthController::class, 'logout']);

});

Route::post("signup", [AuthController::class, 'signup']);
Route::post("login", [AuthController::class, 'login']);

Route::get("products", [ProductController::class, 'index']);
Route::get("products/{id}", [ProductController::class, 'show']);
