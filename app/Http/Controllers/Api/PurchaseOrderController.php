<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderCollection;
use App\Models\PurchaseOrder;

class PurchaseOrderController extends Controller
{
    public function index(): PurchaseOrderCollection
    {
        return  PurchaseOrderCollection::make(PurchaseOrder::with('detailsOrder')->get());
    }
}
