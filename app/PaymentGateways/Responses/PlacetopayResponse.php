<?php

namespace App\PaymentGateways\Responses;

use App\Constants\PlacetopayStatusResponses;
use App\Helpers\PlacetopayJsonResponses;

class PlacetopayResponse
{
    private array $body;
    private ?int $purchaseOrderId;

    public function __construct(array $body,int $purchaseOrderId)
    {
        $this->body = $body;
        $this->purchaseOrderId = $purchaseOrderId;
    }

    public function getResponse(): array
    {
        $statusCode = (array_key_exists('status',$this->body))?$this->body['status']['status'] : 500;

        return match ($statusCode) {
        PlacetopayStatusResponses::OK, PlacetopayStatusResponses::PENDING,
        PlacetopayStatusResponses::REJECTED, PlacetopayStatusResponses::APPROVED, => PlacetopayJsonResponses::transactionRecordOK($this->body,$this->purchaseOrderId),
        PlacetopayStatusResponses::FAILED =>  'RETURN CREDENCIALES INCORRECTAS...'
        };
    }
}
