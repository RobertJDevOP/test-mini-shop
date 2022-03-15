<?php

namespace App\Actions\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface IActionContract
{
    public function execute(array|Request $data): self;

    public function result(): Model;
}
