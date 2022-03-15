<?php

namespace App\Actions\Api\Customer;

use App\Actions\Api\StoreAction;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CustomerStoreAction extends StoreAction
{
    protected Model $model;

    public function execute(array|Request $data): self
    {
        $customer = new Customer();
        $customer->document_number = $data['customerDocumentNumber'];
        $customer->address = $data['customerAddress'];
        $customer->document_type_id = $data['customerDocumentType'];
        $customer->save();

        $this->model = $customer;

        return $this;
    }
}
