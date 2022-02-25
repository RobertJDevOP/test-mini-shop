<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer_name',  'customer_email', 'customer_mobile','user_id','qty','total'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
