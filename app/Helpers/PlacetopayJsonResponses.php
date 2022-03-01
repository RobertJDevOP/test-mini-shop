<?php

namespace App\Helpers;

use App\Actions\Api\PurchasePayment\Store;

class PlacetopayJsonResponses
{
    public static function transactionRecordOK(array $response,int $purchaseOrderId): array
    {
        Store::execute($response,$purchaseOrderId);
        $response['purchaseOrderId'] = $purchaseOrderId;

        return $response;
    }
}
