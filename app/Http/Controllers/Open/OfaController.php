<?php

namespace App\Http\Controllers\Open;

use App\Http\Controllers\Controller;
use EasyWeChat\Kernel\Exceptions\BadRequestException;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\Kernel\Exceptions\RuntimeException;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class OfaController extends Controller
{
    private Application $ofaApp;

    public function __construct()
    {
        $this->ofaApp = app('wechat.ofa');
    }

    /**
     * @throws InvalidArgumentException
     * @throws \Throwable
     * @throws \ReflectionException
     * @throws BadRequestException
     * @throws RuntimeException
     */
    public function auth(): ResponseInterface
    {
        return $this->ofaApp->getServer()->serve();
    }

    /**
     * @throws InvalidArgumentException
     * @throws \Throwable
     * @throws \ReflectionException
     * @throws BadRequestException
     */
    public function receive()
    {
        $decryptedMessage = $this->ofaApp->getServer()->getDecryptedMessage();
        $requestMessage = $this->ofaApp->getServer()->getRequestMessage();

        Log::info('decryptedMessage:, ' . $decryptedMessage->toJson() . "\nrequestMessage:" . $requestMessage->toJson());
    }
}
