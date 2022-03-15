<?php

namespace App\PaymentGateways\Responses;

use App\Constants\P2PStatusResponses;
use App\Helpers\P2PResponses;

class P2PBodyResponse
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
        P2PStatusResponses::OK, P2PStatusResponses::PENDING,
        P2PStatusResponses::REJECTED, P2PStatusResponses::APPROVED, => P2PResponses::transactionRecordOK($this->body,$this->purchaseOrderId),
        P2PStatusResponses::FAILED =>  'RETURN CREDENCIALES INCORRECTAS...'
        };
    }
}
