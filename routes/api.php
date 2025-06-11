<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/user/profile', [\App\Http\Controllers\Api\AuthController::class, 'userProfile'])->middleware('auth:sanctum');
Route::post('/reset-password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword'])->middleware('auth:sanctum');

Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::get('/auth/user', [\App\Http\Controllers\Api\AuthController::class, 'user'])->middleware('auth:sanctum');
Route::post('/refresh-token', [\App\Http\Controllers\Api\AuthController::class, 'refreshToken'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
    Route::get('/products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
    Route::post('/products', [\App\Http\Controllers\Api\ProductController::class, 'store']);
    Route::put('/products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
    Route::delete('/products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'destroy']);
    Route::get('/products/search', [\App\Http\Controllers\Api\ProductController::class, 'search']);
    Route::get('/products/category/{id}', [\App\Http\Controllers\Api\ProductController::class, 'filterByCategory']);
});
