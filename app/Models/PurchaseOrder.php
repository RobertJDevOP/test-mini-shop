<?php

namespace App\Models;

use App\Constants\P2PStatusResponses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_name',  'customer_email', 'customer_mobile','user_id','qty','total'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class,'customer_id', 'id');
    }

    public function detailsOrder(): HasMany
    {
        return $this->hasMany(PurchaseOrderDetail::class,'purchase_order_id', 'id');
    }

    public  function  purchasePaymentsStatus(): HasMany
    {
        return $this->hasMany(PurchasePayment::class,'id_purchase_order','id')
            ->whereIn('purchase_payment.status', [P2PStatusResponses::APPROVED, P2PStatusResponses::REJECTED, P2PStatusResponses::PENDING]);
    }

}
