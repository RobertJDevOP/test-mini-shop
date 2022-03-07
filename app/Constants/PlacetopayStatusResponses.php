<?php

namespace App\Constants;

class PlacetopayStatusResponses
{
    private const STATUSES = ['OK' => 'CREATED','REJECTED' => 'FAILED','APPROVED' => 'PAYED'];
    public const OK = 'OK';
    public const FAILED = 'FAILED';
    public const APPROVED = 'APPROVED';
    public const REJECTED = 'REJECTED';
    public const PENDING = 'PENDING';
    public const UNAUTHORIZED = 'UNAUTHORIZED';
    public const REFUNDED = 'REFUNDED';
    public const ERROR = 'ERROR';
    public const CREATED = 'CREATED';

    public static function getStatus(string $status): string
    {
        return self::STATUSES[$status] ?? 'FAILED';
    }
}
