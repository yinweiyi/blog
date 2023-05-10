<?php

namespace App\Vendors\Wechat;

use EasyWeChat\Kernel\Message;
use Illuminate\Support\Facades\Log;

class CustomHandler
{
    public function __invoke(Message $message, \Closure $next)
    {
        Log::channel('wechat_message')->info('Receive message:' . $message->toJson());
        if ($message->MsgType === 'text') {
            return '感谢您关注 白给AI';
        }

        return $next($message);
    }
}
