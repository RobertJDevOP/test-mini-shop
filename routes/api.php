<?php

use App\Http\Controllers\Api\PurchaseOrderController;
use App\Http\Controllers\Api\DocumentTypeController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('product/', [ProductController::class, 'index']);
    Route::get('documentType/', [DocumentTypeController::class, 'index']);
    Route::post('createOrder/', [PurchaseOrderController::class, 'store']);
    Route::get('purchases/', [PurchaseOrderController::class, 'index']);
});
