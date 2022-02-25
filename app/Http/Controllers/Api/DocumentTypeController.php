<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\DocumentType\Index;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeController extends Controller
{
    public function index(Index $index): JsonResource
    {
        return DocumentTypeResource::collection($index::execute());
    }
}
