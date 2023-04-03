<?php

namespace App\Listeners;

use App\Events\LoginedEvent;
use Illuminate\Support\Facades\Request;

class LoginedListener
{
    /**
     * Handle the event.
     *
     * @param LoginedEvent $event
     * @return void
     */
    public function handle(LoginedEvent $event): void
    {
        $administrator = $event->administrator;
        $administrator
            ->fill(['last_login_ip' => Request::ip(), 'last_login_at' => date('Y-m-d H:i:s')])
            ->save();
    }
}
