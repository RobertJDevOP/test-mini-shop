<?php

namespace App\Http\Controllers;

use App\Events\TransactionProcessed;
use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;
use App\PaymentGateways\PlacetopayWebCheckout;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function createRequest(PurchaseOrder $purchaseOrder): JsonResponse
    {
        $obj = new PlacetopayWebCheckout($purchaseOrder,null);
        $response = $obj->createRequest();


        return response()->json($response);
    }

    public function getRequestInformation(int $purchaseOrderId)//: View
    {
        $purchasePaymentStatus=PurchasePayment::select('requestId')->where('id_purchase_order', $purchaseOrderId)
            ->latest('id_purchase_payment')->first();

        $obj = new PlacetopayWebCheckout($purchaseOrderId,$purchasePaymentStatus->requestId);
        $response = $obj->getRequestInformation();

        /*
        $purchaseOrder=PurchasePayment::select('status','id_purchase_order')->where('id_purchase_order', $purchaseOrderId)
            ->latest('id_purchase_payment')->first();*/

        //
    }
}
