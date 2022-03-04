<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customerDocumentNumber' => ['bail','required', 'numeric','digits_between:5,10'],
            'customerAddress' => ['bail','required', 'string','max:255'],
            'customerDocumentType' => ['bail','required', 'integer','exists:document_types,id'],
            'customerPhone' => ['bail','required', 'numeric','digits:10'],
            'customerEmail' => ['bail','required', 'string','email','max:120'],
            'customerName' => ['bail','required', 'string','max:80'.'min:5'],
            'qtyProduct' => ['bail','required', 'integer','between:1,5'],
        ];
    }
}
