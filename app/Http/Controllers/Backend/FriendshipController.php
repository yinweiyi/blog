<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFriendshipRequest;
use App\Models\Friendship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $friendships = Friendship::query()->orderByDesc('order')->paginate($request->input('pageSize'));

        return $this->success($this->toPageData($friendships));
    }

    /**
     * 保存
     *
     * @param StoreFriendshipRequest $request
     * @return JsonResponse
     */
    public function store(StoreFriendshipRequest $request): JsonResponse
    {
        $attributes = $request->post();

        Friendship::query()->create($attributes);

        return $this->success();
    }

    /**
     * 更新
     *
     * @param StoreFriendshipRequest $request
     * @param Friendship $friendship
     * @return JsonResponse
     */
    public function update(StoreFriendshipRequest $request, Friendship $friendship): JsonResponse
    {
        $attributes = $request->post();
        $friendship->fill(array_filter_null($attributes))->save();
        return $this->success();
    }


    /**
     * @param Request $request
     * @param Friendship $friendship
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Friendship $friendship): JsonResponse
    {
        $status = $request->input('status', true);
        $friendship->setAttribute('status', $status);
        $friendship->save();
        return $this->success();
    }

    /**
     * 删除
     *
     * @param Friendship $friendship
     * @return JsonResponse
     */
    public function delete(Friendship $friendship): JsonResponse
    {
        $friendship->delete();
        return $this->success();
    }

}
