<?php

namespace App\Actions\Api\GeneratePurchaseOrder;

use App\Constants\PurchaseOrderStatus;
use App\Entities\Product;
use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Store
{
    public static function execute(Request $request): Model
    {
        $requestCustomer = $request['params'];
        $product = new Product();

        $customer = new Customer();
        $customer->document_number = $requestCustomer['customer']['customerDocumentNumber'];
        $customer->address = $requestCustomer['customer']['customerStreet'];
        $customer->document_type_id = $requestCustomer['customer']['customerDocumentType'];
        $customer->save();

        $order= new PurchaseOrder();
        $order->customer_name = $requestCustomer['customer']['customerName'];
        $order->customer_email = $requestCustomer['customer']['customerEmail'];
        $order->customer_mobile = $requestCustomer['customer']['customerPhone'];
        $order->status = PurchaseOrderStatus::CREATED;
        $order->customer_id = $customer->id;
        $order->qty = $requestCustomer['qtyProduct'];
        $order->total = $product->getPrice()*$requestCustomer['qtyProduct'];
        $order->save();

        $detailOrder= new PurchaseOrderDetail();
        $detailOrder->purchase_order_id=$order->id;
        $detailOrder->product_id=$product->getReference();
        $detailOrder->qty=$requestCustomer['qtyProduct'];
        $detailOrder->price=$product->getPrice();
        $detailOrder->save();

        return $order;
    }
}
