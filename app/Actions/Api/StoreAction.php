<?php

namespace App\Actions\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class StoreAction implements IActionContract
{
    protected Model $model;

    abstract public function execute(array|Request $data): IActionContract;

    public function result(): Model
    {
        return $this->model;
    }
}
