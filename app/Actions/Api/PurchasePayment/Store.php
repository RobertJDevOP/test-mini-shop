<?php

namespace App\Actions\Api\PurchasePayment;

use App\Constants\PlacetopayStatusResponses;
use App\Models\PurchasePayment;

class Store
{
    public static function execute(array $data,int $purchaseOrderId): void
    {
        $statusTransaction = PlacetopayStatusResponses::getStatus($data['status']['status']);

        $purchasePayment = new PurchasePayment();
        $purchasePayment->id_purchase_order = $purchaseOrderId;
        $purchasePayment->requestId = $data['requestId'];
        $purchasePayment->processUrl = $data['processUrl'] ?? null;
        $purchasePayment->status = $statusTransaction;
        $purchasePayment->save();
    }
}
