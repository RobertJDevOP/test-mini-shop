<?php

namespace App\Constants;

class P2PStatusResponses
{
    public const OK = 'OK';
    public const FAILED = 'FAILED';
    public const APPROVED = 'APPROVED';
    public const REJECTED = 'REJECTED';
    public const PENDING = 'PENDING';
    public const UNAUTHORIZED = 'UNAUTHORIZED';
    public const REFUNDED = 'REFUNDED';
    public const ERROR = 'ERROR';
    public const CREATED = 'CREATED';
    private const STATUSES = [self::OK => 'CREATED', self::REJECTED => 'REJECTED',self::APPROVED => 'PAYED',self::PENDING => 'PENDING'];

    public static function getStatus(string $status): string
    {
        return self::STATUSES[$status] ?? self::FAILED;
    }
}
