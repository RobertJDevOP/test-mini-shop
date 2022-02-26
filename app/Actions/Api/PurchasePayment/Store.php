<?php

namespace App\Actions\Api\PurchasePayment;

use App\Models\PurchasePayment;

class Store
{
    public static function execute(array $data,int $purchaseOrderId): void
    {
        $purchasePayment = new PurchasePayment();
        $purchasePayment->id_purchase_order = $purchaseOrderId;
        $purchasePayment->requestId = $data['requestId'];
        $purchasePayment->processUrl = $data['processUrl'] ?? null;
        $purchasePayment->status = $data['status']['status'];
        $purchasePayment->save();
    }
}
