<?php

namespace App\Actions\Api\PurchasePayment;

use App\Models\PurchasePayment;
use Illuminate\Support\Facades\Log;

class Store
{
    public static function execute(array $data,int $purchaseOrderId): void
    {
        if('OK' === $data['status']['status']){
            $statusTransaction = 'CREATED';
        }else if('APPROVED' === $data['status']['status']) {
            $statusTransaction = 'PAYED';
        }else{
            $statusTransaction = $data['status']['status'];
        }

        $purchasePayment = new PurchasePayment();
        $purchasePayment->id_purchase_order = $purchaseOrderId;
        $purchasePayment->requestId = $data['requestId'];
        $purchasePayment->processUrl = $data['processUrl'] ?? null;
        $purchasePayment->status = $statusTransaction;
        $purchasePayment->save();
    }
}
