<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\GeneratePurchaseOrder\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class GeneratePurchaseOrderController extends Controller
{
    public function store(Request $request,Store $storeAction): RedirectResponse
    {
        $orderGenerate = $storeAction::execute($request);

        return redirect(route('shop.checkout', [$orderGenerate]));
    }
}
