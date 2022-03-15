<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\PurchaseOrder\PurchaseOrderStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOrderPostRequest;
use App\Http\Resources\PurchaseOrderCollection;
use App\Models\PurchaseOrder;
use Illuminate\Http\RedirectResponse;

class PurchaseOrderController extends Controller
{
    public function store(PurchaseOrderPostRequest $request, PurchaseOrderStoreAction $storeAction): RedirectResponse
    {
        $purchaseOrder = $storeAction->execute($request)->result();

        return redirect(route('shop.checkout', [$purchaseOrder->id]));
    }

    public function index(): PurchaseOrderCollection
    {
        return  PurchaseOrderCollection::make(PurchaseOrder::with('detailsOrder')->get());
    }
}
