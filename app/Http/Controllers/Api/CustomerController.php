<?php

namespace App\Http\Controllers\Api;

use App\Actions\Api\Customer\Store;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request,Store $storeAction)
    {
      $storeAction::execute($request);
    }
}
