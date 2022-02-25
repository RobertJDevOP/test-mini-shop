<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'product',
            'attributes'=>[
                'product_name' => $this->name,
                'price' => $this->getPrice(),
                'picture' => $this->urlImage,
                'code' => $this->getReference(),
                'description' => $this->description,
            ],
        ];
    }
}
