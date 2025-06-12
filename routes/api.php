<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\Api\V1\AuthController;
// use App\Http\Controllers\API\V1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Superadmin routes
Route::middleware(['auth:sanctum', 'superadmin'])->group(function () {
    // User management routes
    Route::post('/users', [UserController::class, 'createUser']);
    Route::get('/users', [UserController::class, 'getUsers']);
    Route::get('/users/{id}', [UserController::class, 'getUser']);
});

// Route::get('/user/profile', [\App\Http\Controllers\Api\AuthController::class, 'userProfile'])->middleware('auth:sanctum');
// Route::post('/reset-password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword'])->middleware('auth:sanctum');

// Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
// Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
// Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

// Route::get('/auth/user', [\App\Http\Controllers\Api\AuthController::class, 'user'])->middleware('auth:sanctum');
// Route::post('/refresh-token', [\App\Http\Controllers\Api\AuthController::class, 'refreshToken'])->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/products', [\App\Http\Controllers\Api\ProductController::class, 'index']);
//     Route::get('/products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
//     Route::post('/products', [\App\Http\Controllers\Api\ProductController::class, 'store']);
//     Route::put('/products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'update']);
//     Route::delete('/products/{id}', [\App\Http\Controllers\Api\ProductController::class, 'destroy']);
//     Route::get('/products/search', [\App\Http\Controllers\Api\ProductController::class, 'search']);
//     Route::get('/products/category/{id}', [\App\Http\Controllers\Api\ProductController::class, 'filterByCategory']);
// });

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/sales', [\App\Http\Controllers\SalesController::class, 'index']);
//     Route::get('/sales/{id}', [\App\Http\Controllers\SalesController::class, 'show']);
//     Route::post('/sales', [\App\Http\Controllers\SalesController::class, 'store']);
//     Route::put('/sales/{id}', [\App\Http\Controllers\SalesController::class, 'update']);
//     Route::get('/sales/search', [\App\Http\Controllers\SalesController::class, 'search']);
//     Route::delete('/sales/{id}', [\App\Http\Controllers\SalesController::class, 'destroy']);
//     Route::get('/sales/report', [\App\Http\Controllers\SalesController::class, 'report']);
//     Route::get('/sales/filter', [\App\Http\Controllers\SalesController::class, 'filter']);
//     Route::get('/sales/satistics', [\App\Http\Controllers\SalesController::class, 'statistics']);
//     Route::get('sales/recentsales', [\App\Http\Controllers\SalesController::class, 'recentSales']);
// });


// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/inventary', [\App\Http\Controllers\InventaryController::class, 'index']);
//     Route::get('/inventary/{id}', [\App\Http\Controllers\InventaryController::class, 'show']);
//     Route::post('/inventary', [\App\Http\Controllers\InventaryController::class, 'store']);
//     Route::put('/inventary/{id}', [\App\Http\Controllers\InventaryController::class, 'update']);
//     Route::delete('/inventary/{id}', [\App\Http\Controllers\InventaryController::class, 'destroy']);
// });
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/purchase-orders', [\App\Http\Controllers\PurchaseOrderController::class, 'index']);
//     Route::get('/purchase-orders/{id}', [\App\Http\Controllers\PurchaseOrderController::class, 'show']);
//     Route::post('/purchase-orders', [\App\Http\Controllers\PurchaseOrderController::class, 'store']);
//     Route::put('/purchase-orders/{id}', [\App\Http\Controllers\PurchaseOrderController::class, 'update']);
//     Route::get('/purchase-orders/search', [\App\Http\Controllers\PurchaseOrderController::class, 'search']);
//     Route::get('/purchase-orders/report', [\App\Http\Controllers\PurchaseOrderController::class, 'report']);
//     Route::get('/purchase-orders/filter/{productId}', [\App\Http\Controllers\PurchaseOrderController::class, 'filter']);
//     Route::delete('/purchase-orders/{id}', [\App\Http\Controllers\PurchaseOrderController::class, 'destroy']);
// });

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/suppliers', [\App\Http\Controllers\SupplierController::class, 'index']);
//     Route::get('/suppliers/{id}', [\App\Http\Controllers\SupplierController::class, 'show']);
//     Route::post('/suppliers', [\App\Http\Controllers\SupplierController::class, 'store']);
//     Route::put('/suppliers/{id}', [\App\Http\Controllers\SupplierController::class, 'update']);
//     Route::delete('/suppliers/{id}', [\App\Http\Controllers\SupplierController::class, 'destroy']);
// });

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
       
        Route::post('/login', [AuthController::class, 'login']);

        Route::middleware('auth:api')->group(function () {
            

        });
    });
    
    Route::middleware('auth:api')->group(function () {

       
        Route::middleware('admin')->group(function () {

        });
        
        
    });
    


    // User Management Routes (Superadmin only)
    Route::prefix('user')->middleware(['auth:api', 'admin'])->group(function () {
        Route::post('/', [UserController::class, 'createUser']);
        Route::get('/', [UserController::class, 'getUsers']);
        Route::get('/{id}', [UserController::class, 'getUser']);
        Route::put('/{id}', [UserController::class, 'updateUser']);
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
        Route::post('/{id}/activate', [UserController::class, 'activateUser']);
        Route::post('/{id}/deactivate', [UserController::class, 'deactivateUser']);
    });
    
});


