<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'detail_purchase_order';

    protected $fillable = [
        'purchase_order_id','product_id','qty','price'
    ];

    public function PurchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class ,'purchase_order_id', 'id');
    }

    public function getQtyAttribute()
    {
        return $this->attributes['qty'];
    }
}
