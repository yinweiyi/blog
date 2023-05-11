<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use EasyWeChat\Kernel\Exceptions\RuntimeException;
use EasyWeChat\Kernel\Form\File;
use EasyWeChat\Kernel\Form\Form;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
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
        $response = $this->ofaApp->getClient()->get('/cgi-bin/get_current_selfmenu_info');
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
        $response = $this->ofaApp->getClient()->post('/cgi-bin/menu/create', [
                'json' => $request->post()
            ]
        );
        $content = \json_decode($response->getContent(), true);

        return Arr::get($content, 'errcode') === 0 ? $this->success() : $this->error(Arr::get($content, 'errmsg', '发布失败'));
    }


    /**
     * 素材
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function material(Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $pageSize = $request->get('pageSize', 15);
        $offset = ($page - 1) * $pageSize;

        $response = $this->ofaApp->getClient()->post('/cgi-bin/material/batchget_material', [
            'json' => [
                'type'   => $request->get('type', 'image'),
                'offset' => $offset,
                'count'  => $pageSize
            ]
        ]);

        $content = \json_decode($response->getContent(), true);

        Log::info($content);
        return $this->success([
            'list'  => $content['item'] ?? [],
            'total' => $content['total_count'] ?? 0
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface|RuntimeException
     */
    public function addMaterial(Request $request): JsonResponse
    {
        $options = Form::create(
            [
                'media' => File::withContents($request->file('file')->getContent(),$request->post('fileName'))
            ]
        )->toArray();

        $options['query'] = ['type' => $request->post('mediaType', 'image')];

        $response = $this->ofaApp->getClient()->post('/cgi-bin/material/add_material', $options);

        $content = \json_decode($response->getContent(), true);

        return Arr::get($content, 'media_id') ? $this->success() : $this->error(Arr::get($content, 'errmsg', '上传失败'));
    }
}
