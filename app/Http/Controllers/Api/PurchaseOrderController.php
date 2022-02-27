<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $purchaseOrders = PurchaseOrder::all();
        $ordersPaymentDetails = array();

        foreach ($purchaseOrders as $row){
            $ordersPaymentDetails[$row->id]=$row;

            foreach ($row->purchasePaymentsStatus as $row2){
                $ordersPaymentDetails[$row->id][$row2->id_purchase_order]=$row2['purchase_payments_status'];
            }
        }

        return response()->json($ordersPaymentDetails);
    }
}
