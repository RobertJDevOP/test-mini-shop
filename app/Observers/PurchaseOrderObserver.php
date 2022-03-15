<?php

namespace App\Observers;

use App\Actions\Api\PurchaseOrderDetail\PurchaseOrderDetailStoreAction;
use App\Models\PurchaseOrder;


class PurchaseOrderObserver
{
    public function created(PurchaseOrder $purchaseOrder,): void
    {
        $storeAction = new PurchaseOrderDetailStoreAction();

        $storeAction->execute(['purchase_order_id' => $purchaseOrder->id, 'qtyProduct' => $purchaseOrder->qty]);
    }
}
