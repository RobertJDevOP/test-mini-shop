<?php

namespace App\PaymentGateways;

interface IGatewayApiWallet
{
    public function createRequest(): array;

    public function getRequestInformation(): array;
}
