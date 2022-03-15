<?php

namespace App\Helpers;

use App\Actions\Api\PurchasePayment\PurchasePaymentStoreAction;

class P2PResponses
{
    public static function transactionRecordOK(array $response,?int $purchaseOrderId): array
    {
        $storePurchasePayment = new PurchasePaymentStoreAction();
        $response['purchaseOrderId'] = $purchaseOrderId;
        $storePurchasePayment->execute($response);

        return $response;
    }
}
