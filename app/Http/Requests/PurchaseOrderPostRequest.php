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
        $customer = $this->request->all()['params']['customer'];
        return [
            $customer['customerDocumentNumber'] => ['bail','required', 'numeric', 'min:5|max:10'],
        ];
    }
}
