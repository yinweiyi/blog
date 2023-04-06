<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $tags = Tag::query()->orderBy('order')->paginate($request->input('pageSize'));

        return $this->success($this->toPageData($tags));
    }

    /**
     * 保存
     *
     * @param StoreTagRequest $request
     * @return JsonResponse
     */
    public function store(StoreTagRequest $request): JsonResponse
    {
        $attributes = $request->post();

        Tag::query()->create($attributes);

        return $this->success();
    }

    /**
     * 更新
     *
     * @param StoreTagRequest $request
     * @param Tag $tag
     * @return JsonResponse
     */
    public function update(StoreTagRequest $request, Tag $tag): JsonResponse
    {
        $attributes = $request->post();
        $tag->fill(array_filter_null($attributes))->save();
        return $this->success();
    }

    /**
     * 删除
     *
     * @param Tag $tag
     * @return JsonResponse
     */
    public function delete(Tag $tag): JsonResponse
    {
        $tag = Tag::query()->where('id', $tag->getAttribute('id'))->with('articles')->first();
        if (!$tag->articles->isEmpty()) {
            return $this->error('此标签绑定了文章，不可删除');
        }
        $tag->delete();
        return $this->success();
    }

}
