<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return [
            'purchase_order_id' => $this->purchase_order_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'total' => $this->total,
        ];
    }
}
