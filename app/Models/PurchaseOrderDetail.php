<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'detail_purchase_order';

    protected $fillable = [
        'purchase_order_id','product_id','qty','price'
    ];
}
