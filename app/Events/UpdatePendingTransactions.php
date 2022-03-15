<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatePendingTransactions implements ShouldBroadcastNow
{
    use SerializesModels, Dispatchable;

    public string $message;

    public function __construct(string $message)
    {
        $this->message=$message;
    }

    public function broadcastOn():Channel
    {
        return new Channel('updatedTransactions');
    }
}
