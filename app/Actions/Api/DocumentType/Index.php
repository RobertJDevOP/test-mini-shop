<?php

namespace App\Actions\Api\DocumentType;

use App\Models\DocumentType;

class Index
{
    public static function execute()
    {
        return DocumentType::all('type', 'description','id');
    }

}
