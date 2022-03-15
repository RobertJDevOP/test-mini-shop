<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;
use App\PaymentGateways\P2PWebCheckout;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
        $p2pCheckout = new P2PWebCheckout($purchaseOrder,null);
        $response = $p2pCheckout->createRequest();

        return response()->json($response);
    }

    public function getRequestInformation(int $purchaseOrderId): JsonResponse
    {
        $purchasePaymentStatus=PurchasePayment::select('requestId')->where('id_purchase_order', $purchaseOrderId)
            ->latest('id_purchase_payment')->first();

        $p2pCheckout = new P2PWebCheckout($purchaseOrderId,$purchasePaymentStatus->requestId);
        $response = $p2pCheckout->getRequestInformation();

        return response()->json($response);
    }

    public function continuePayment(int $purchaseOrderId): JsonResponse
    {
        $purchasePayment = PurchasePayment::select('processUrl')->where('id_purchase_order', $purchaseOrderId)
            ->latest('id_purchase_payment')->first();

       return response()->json(['processUrl' => $purchasePayment->processUrl]);
    }

}
