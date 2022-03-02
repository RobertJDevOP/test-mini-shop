<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderPostRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customerDocumentNumber' => ['required', 'numeric'],
            'customerStreet' => ['required', 'string'],
            'customerDocumentType' => ['required', 'numeric','exists:document_types,id'],
            'customerName' => ['required', 'string'],
            'customerEmail' => ['required', 'string'],
            'customerPhone' => ['required', 'numeric'],
            'qtyProduct' => ['required', 'numeric'],
        ];
    }
}
