<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderCollection;
use App\Models\PurchaseOrder;
use Illuminate\Http\JsonResponse;

class PurchaseOrderController extends Controller
{
    public function index()//: JsonResponse
    {

        /*$purchaseOrders = PurchaseOrder::all();
        $ordersPaymentDetails = array();

        foreach ($purchaseOrders as $row){
            $ordersPaymentDetails[$row->id]=$row;
            foreach ($row->detailsOrder as $row2){
                $ordersPaymentDetails[$row->id][$row2->purchase_order_id]=$row2['details_order'];
            }
        }*/
        return  PurchaseOrderCollection::make(PurchaseOrder::with('detailsOrder')->get());
       // return response()->json($ordersPaymentDetails);
    }
}
