<?php

use App\Http\Controllers\Api\PurchasePaymentController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('shop.checkout')->get('/checkout/{purchaseOrder}/', [PaymentController::class, 'createRequest']);
Route::name('payment.checkout')->get('/payment/{order}',[PaymentController::class,'getRequestInformation']);
Route::name('payment.checkout')->post('/paymentStatus/{purchaseOrder}',[PurchasePaymentController::class,'store']);
