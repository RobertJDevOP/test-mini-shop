<?php

namespace App\Observers;

use App\Constants\PurchaseOrderStatus;
use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;

class PurchasePaymentObserver
{
    public function created(PurchasePayment $purchasePayment): void
    {
        if(PurchaseOrderStatus::CREATED === $purchasePayment->status || PurchaseOrderStatus::PAYED === $purchasePayment->status
        || PurchaseOrderStatus::REJECTED === $purchasePayment->status){
            PurchaseOrder::where('id', $purchasePayment->id_purchase_order)->update(['status' => $purchasePayment->status]);
        }

    }
}
