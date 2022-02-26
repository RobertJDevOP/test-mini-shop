<?php

namespace App\Helpers;

use App\Actions\Api\PurchasePayment\Store;

class PlacetopayJsonResponses
{
    public static function transactionRecordOK(array $response,int $purchaseOrderId): array
    {
        Store::execute($response,$purchaseOrderId);

        return $response;
    }

    public static function transactionRecordFailed(array $response): array
    {
        //Store::execute($response,$purchaseOrderId);

        return $response;
    }

    public static function transactionRecordApproved(array $response,int $purchaseOrderId): array
    {
       Store::execute($response,$purchaseOrderId);

       return $response;
    }

}
