<?php

namespace App\PaymentGateways\Responses;

use App\Constants\PlacetopayStatusResponses;
use App\Helpers\PlacetopayJsonResponses;

class PlacetopayResponse
{
    private array $body;
    private int $purchaseOrderId;

    public function __construct(array $body,int $purchaseOrderId)
    {
        $this->body = $body;
        $this->purchaseOrderId = $purchaseOrderId;
    }

    public function getResponse(): array
    {
        $statusCode = ($this->body['status'])?$this->body['status']['status']:$statusCode = 500;

        return match ($statusCode) {
        PlacetopayStatusResponses::OK => PlacetopayJsonResponses::transactionRecordOK($this->body,$this->purchaseOrderId),
        PlacetopayStatusResponses::FAILED => PlacetopayJsonResponses::transactionRecordFailed($this->body),
        PlacetopayStatusResponses::APPROVED => PlacetopayJsonResponses::transactionRecordApproved($this->body,$this->purchaseOrderId),
        PlacetopayStatusResponses::REJECTED => PlacetopayJsonResponses::transactionRecordRejected($this->body,$this->purchaseOrderId),
        };
    }
}
