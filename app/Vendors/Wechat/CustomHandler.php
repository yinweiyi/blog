<?php

namespace App\Vendors\Wechat;

use App\Http\Services\ImageService;
use EasyWeChat\Kernel\Message;
use Illuminate\Support\Facades\Log;

class CustomHandler
{
    public function __invoke(Message $message, \Closure $next)
    {
        Log::channel('wechat_message')->info('Receive message:' . $message->toJson());

        $messageType = $message->offsetGet('MsgType');

        return match ($messageType) {
            'text' => $this->handleText($message),
            'event' => $this->handleEvent($message),
            default => $next($message),
        };


    }


    /**
     * 关注自动回复
     *
     * @param Message $message
     * @return string|array
     */
    private function handleEvent(Message $message): string|array
    {
        $event= $message->offsetGet('Event');
        if ($event === 'subscribe'){
            return '你好，感谢关注 白给COM 公众号。我会第一时间分享最新的资讯、技术、应用和趋势。如果您有任何问题或建议，欢迎随时联系我。';
        } elseif ($event === 'CLICK') {
            if ($message->offsetGet('EventKey') === 'RANDOM_AI_IMAGE') {
                //随机图片
                $imageService = new ImageService();
                return [
                    'MsgType' => 'image',
                    'Image' => [
                        'MediaId' => $imageService->randomMediaId(),
                    ],
                ];
            }
        }

        return '';
    }

    /**
     * 处理消息
     *
     * @param Message $message
     * @return string
     */
    private function handleText(Message $message): string
    {
        return '感谢您关注 白给COM';
    }
}
