<?php

namespace App\Events;

use App\Models\Administrator;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Administrator $administrator;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Administrator $administrator)
    {
        $this->administrator = $administrator;
    }

}
