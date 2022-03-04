<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PurchaseOrderCollection extends ResourceCollection
{
    public function toArray($request): array
    {
        return [
            'data' => PurchaseOrderResource::collection($this->collection),
            'meta' => [
                'purchases_count' => $this->collection->count()
            ]
        ];
    }
}
