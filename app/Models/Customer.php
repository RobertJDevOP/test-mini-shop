<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'users';

    use  HasFactory;

    protected $fillable = [
        'document_number',
        'address',
        'document_type_id',
    ];

}
