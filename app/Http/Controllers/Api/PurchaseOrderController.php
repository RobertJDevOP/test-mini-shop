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
            foreach ($row->detailsOrder as $row2){
                $ordersPaymentDetails[$row->id][$row2->purchase_order_id]=$row2['details_order'];
            }
        }

        return response()->json($ordersPaymentDetails);
    }
}
