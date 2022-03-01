<?php

namespace App\Http\Controllers;

use App\Events\TransactionProcessed;
use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;
use App\PaymentGateways\PlacetopayWebCheckout;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
        $obj = new PlacetopayWebCheckout($purchaseOrder,null);
        $response = $obj->createRequest();

        return response()->json($response);
    }

    public function getRequestInformation(int $purchaseOrderId): JsonResponse
    {
        $purchasePaymentStatus=PurchasePayment::select('requestId')->where('id_purchase_order', $purchaseOrderId)
            ->latest('id_purchase_payment')->first();

        $obj = new PlacetopayWebCheckout($purchaseOrderId,$purchasePaymentStatus->requestId);
        $response = $obj->getRequestInformation();

        return response()->json($response);
    }

    public function continuePayment(int $purchaseOrderId): JsonResponse
    {
        $purchasePayment = PurchasePayment::select('processUrl')->where('id_purchase_order', $purchaseOrderId)
            ->latest('id_purchase_payment')->first();

       return response()->json(['processUrl' => $purchasePayment->processUrl]);
    }

}
