<?php

namespace App\Vendors\Wechat;

class CustomHandler
{
    public function __invoke($message, \Closure $next)
    {
        if ($message->MsgType === 'text') {
            return '感谢您关注 白给AI';
        }

        return $next($message);
    }
}
