<?php

namespace App\Constants;

use Illuminate\Contracts\Support\Arrayable;

class CustomerDocumentType implements Arrayable
{
    public const CC = 'CC';
    public const TI = 'TI';
    public const CE = 'CE';
    public const NIT = 'NIT';
    public const RUT = 'RUT';

    public function toArray(): array
    {
        return [
            self::CC,
            self::TI,
            self::CE,
            self::NIT,
            self::RUT,
        ];
    }
}
