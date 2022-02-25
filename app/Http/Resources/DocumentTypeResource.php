<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => 'document_type',
            'attributes'=>[
                'id' => $this->id,
                'name' => $this->type,
                'desc' => $this->description,
            ],
        ];
    }
}
