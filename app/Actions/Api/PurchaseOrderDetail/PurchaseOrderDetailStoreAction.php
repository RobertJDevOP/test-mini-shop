<?php

namespace App\Actions\Api\PurchaseOrderDetail;

use App\Actions\Api\StoreAction;
use App\Entities\Product;
use App\Models\PurchaseOrderDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PurchaseOrderDetailStoreAction extends StoreAction
{
    protected Model $model;

    public function execute(array|Request $data): self
    {
        $product = new Product();

        $detailOrder= new PurchaseOrderDetail();
        $detailOrder->purchase_order_id=$data['purchase_order_id'];
        $detailOrder->product_id=$product->getReference();
        $detailOrder->qty=$data['qtyProduct'];
        $detailOrder->price=$product->getPrice();
        $detailOrder->save();

        $this->model = $detailOrder;

        return $this;
    }
}
