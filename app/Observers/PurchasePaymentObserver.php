<?php

namespace App\Observers;

use App\Constants\PlacetopayStatusResponses;
use App\Models\PurchaseOrder;
use App\Models\PurchasePayment;

class PurchasePaymentObserver
{
    public function created(PurchasePayment $purchasePayment): void
    {
        if(PlacetopayStatusResponses::CREATED === $purchasePayment->status || PlacetopayStatusResponses::APPROVED === $purchasePayment->status
        || PlacetopayStatusResponses::REJECTED === $purchasePayment->status){
            PurchaseOrder::where('id', $purchasePayment->id_purchase_order)->update(['status' => $purchasePayment->status]);
        }

    }
}
