<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\GeneratePurchaseOrder\Store;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseOrderPostRequest;
use Illuminate\Http\RedirectResponse;

class GeneratePurchaseOrderController extends Controller
{
    public function store(PurchaseOrderPostRequest $request,Store $storeAction): RedirectResponse
    {
        $orderGenerate = $storeAction::execute($request);

        return redirect(route('shop.checkout', [$orderGenerate]));
    }
}
