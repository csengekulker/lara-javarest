<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("signup", [AuthController::class, 'signup']);
Route::post("login", [AuthController::class, 'login']);
Route::post("logout", [AuthController::class, 'logout']);

//vedett
Route::get("products", [ProductController::class, 'index']);
Route::post("new-product", [ProductController::class, 'create']);
Route::get("products/{id}", [ProductController::class, 'show']);
Route::put("products/{id}", [ProductController::class, 'update']);
Route::delete("products/{id}", [ProductController::class, 'destroy']);