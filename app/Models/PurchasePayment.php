<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
    use HasFactory;

    protected $table = 'purchase_payment';

    protected $fillable = [
        'id_purchase_order',  'status', 'requestId','processUrl'
    ];
}
