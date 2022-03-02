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
        $product = new Product();

        $customer = new Customer();
        $customer->document_number = $request['customerDocumentNumber'];
        $customer->address = $request['customerStreet'];
        $customer->document_type_id = $request['customerDocumentType'];
        $customer->save();

        $order= new PurchaseOrder();
        $order->customer_name = $request['customerName'];
        $order->customer_email = $request['customerEmail'];
        $order->customer_mobile = $request['customerPhone'];
        $order->status = PurchaseOrderStatus::CREATED;
        $order->customer_id = $customer->id;
        $order->qty = $request['qtyProduct'];
        $order->total = $product->getPrice()*$request['qtyProduct'];
        $order->save();

        $detailOrder= new PurchaseOrderDetail();
        $detailOrder->purchase_order_id=$order->id;
        $detailOrder->product_id=$product->getReference();
        $detailOrder->qty=$request['qtyProduct'];
        $detailOrder->price=$product->getPrice();
        $detailOrder->save();

        return $order;
    }
}
