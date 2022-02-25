<?php

namespace App\Actions\Api\PurchaseOrder;

use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class Store
{
    public static function execute(Request $request): PurchaseOrder
    {
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->customer_name = $request->code;
        $purchaseOrder->customer_email = $request->product_name;
        $purchaseOrder->customer_mobile = $request->category_id;
        $purchaseOrder->user_id = $request->category_id;
        $purchaseOrder->qty = $request->category_id;
        $purchaseOrder->total = $request->category_id;
        $purchaseOrder->save();
        $purchaseOrder->message = 'Purchase order created successfully';

        return $purchaseOrder;
    }
}
