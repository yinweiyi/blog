<?php

namespace App\Vendors\Wechat;

class CustomHandler
{
    public function __invoke($message, \Closure $next)
    {
        if ($message->MsgType === 'text') {
            return '感谢你使用 EasyWeChat';
        }

        return $next($message);
    }
}
