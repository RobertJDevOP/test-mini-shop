<?php

namespace App\Observers;

use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;

class PurchasePaymentObserver
{
    public function created(PurchasePayment $purchasePayment): void
    {
        PurchaseOrder::where('id', $purchasePayment->id_purchase_order)->update(['status' => $purchasePayment->status]);
    }
}
