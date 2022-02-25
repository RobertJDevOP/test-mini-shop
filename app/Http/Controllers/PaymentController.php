<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
        dd($purchaseOrder);
       /* $paymentGateway = app()->make(FactoryApiWalletGateway::class,[$purchaseOrder,null,null,$wallet]);

        $response = $paymentGateway->apiConnect();

        return response()->json($response->getData()->processUrl);*/
    }
}
