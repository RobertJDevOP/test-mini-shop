<?php

namespace App\Actions\Api\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;

class Store
{
    public static function execute(Request $request): Customer
    {
        $requestCustomer = $request['params']['customer'];

        $customer = new Customer();
        $customer->document_number = $requestCustomer['customerDocumentNumber'];
        $customer->address = $requestCustomer['customerStreet'];
        $customer->document_type_id = $requestCustomer['customerDocumentType'];
        $customer->save();
        $customer->message = 'Purchase order created successfully';

        return $customer;
    }
}
