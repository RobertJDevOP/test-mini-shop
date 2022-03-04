<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'type' => 'purchase_order',
            'attributes'=>[
                'status' => $this->status,
                'qty' => $this->qty,
                'total' => $this->total,
                'id' => $this->id,
                'created_at' => $this->created_at->toDateString(),
            ],
            'relationships' => New PurchaseOrderDetailResource($this->detailsOrder),
        ];
    }
}
