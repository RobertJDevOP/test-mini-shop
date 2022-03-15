<?php

namespace App\Actions\Api\PurchasePayment;

use App\Actions\Api\StoreAction;
use App\Constants\P2PStatusResponses;
use App\Models\PurchasePayment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PurchasePaymentStoreAction extends StoreAction
{
    protected Model $model;

    public function execute(array|Request $data): self
    {
        $statusTransaction = P2PStatusResponses::getStatus($data['status']['status']);

        $purchasePayment = new PurchasePayment();
        $purchasePayment->id_purchase_order = $data['purchaseOrderId'];
        $purchasePayment->requestId = $data['requestId'];
        $purchasePayment->processUrl = $data['processUrl'] ?? null;
        $purchasePayment->status = $statusTransaction;
        $purchasePayment->save();

        $this->model = $purchasePayment;

        return $this;
    }
}
