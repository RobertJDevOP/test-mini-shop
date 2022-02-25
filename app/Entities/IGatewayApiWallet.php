<?php

namespace App\Entities;

interface IGatewayApiWallet
{
    public function createRequest(): object;

    public function getSession();
}
