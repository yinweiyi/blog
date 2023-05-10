<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class OfficialAccountController extends Controller
{
    /**
     * @var Application|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private Application $ofaApp;

    public function __construct()
    {
        $this->ofaApp = app('wechat.ofa');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function menu(): JsonResponse
    {
        $response = $this->ofaApp->getClient()->get("/cgi-bin/get_current_selfmenu_info");
        $content = \json_decode($response->getContent(), true);

        return $this->success(Arr::get($content, 'selfmenu_info'));
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function publishMenu(Request $request): JsonResponse
    {
        $response = $this->ofaApp->getClient()->post("/cgi-bin/menu/create", [
                'json' => $request->post()
            ]
        );
        $content = \json_decode($response->getContent(), true);

        return Arr::get($content, 'errcode') === 0 ? $this->success() : $this->error(Arr::get($content, 'errmsg', '发布失败'));
    }
}
