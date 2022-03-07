<?php

namespace App\Actions\Api\PurchasePayment;

use App\Constants\PlacetopayStatusResponses;
use App\Models\PurchasePayment;
use Illuminate\Support\Facades\Log;

class Store
{
    public static function execute(array $data,int $purchaseOrderId): void
    {
        Log::error('Test var fails' ,[$data['status']['status']]);
        $statusTransaction = PlacetopayStatusResponses::getStatus($data['status']['status']);

        $purchasePayment = new PurchasePayment();
        $purchasePayment->id_purchase_order = $purchaseOrderId;
        $purchasePayment->requestId = $data['requestId'];
        $purchasePayment->processUrl = $data['processUrl'] ?? null;
        $purchasePayment->status = $statusTransaction;
        $purchasePayment->save();
    }
}
