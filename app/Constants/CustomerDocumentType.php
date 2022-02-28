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
    public const DESC_CC = 'Cédula de ciudadanía';
    public const DESC_TI = 'Tarjeta de identidad';
    public const DESC_CE = 'Cédula de extranjería';
    public const DESC_NIT = 'Número de Identificación';
    public const DESC_RUT = 'Registro único tributario';

    public function toArray(): array
    {
        return [
            ['type'=>self::CC,'description'=>self::DESC_CC],
            ['type'=>self::TI,'description'=>self::DESC_TI],
            ['type'=>self::CE,'description'=>self::DESC_CE],
            ['type'=>self::NIT,'description'=>self::DESC_NIT],
            ['type'=>self::RUT,'description'=>self::DESC_RUT],
        ];
    }
}
