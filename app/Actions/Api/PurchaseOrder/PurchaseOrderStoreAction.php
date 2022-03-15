<?php

namespace App\Actions\Api\PurchaseOrder;

use App\Actions\Api\Customer\CustomerStoreAction;
use App\Actions\Api\StoreAction;
use App\Constants\PurchaseOrderStatus;
use App\Entities\Product;
use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PurchaseOrderStoreAction extends StoreAction
{
    protected Model $model;

    public function execute(array|Request $data): self
    {
        $product = new Product();
        $customerStoreAction = new CustomerStoreAction();
        $customer = $customerStoreAction->execute($data)->result();

        $order = new PurchaseOrder();
        $order->customer_name = $data['customerName'];
        $order->customer_email = $data['customerEmail'];
        $order->customer_mobile = $data['customerPhone'];
        $order->status = PurchaseOrderStatus::CREATED;
        $order->customer_id = $customer->id;
        $order->qty = $data['qtyProduct'];
        $order->total = $product->getPrice()*$data['qtyProduct'];
        $order->save();

        $this->model = $order;

        return $this;
    }
}
