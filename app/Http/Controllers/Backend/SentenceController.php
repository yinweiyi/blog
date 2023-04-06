<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSentenceRequest;
use App\Models\Sentence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SentenceController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $sentences = Sentence::query()->orderByDesc('id')->paginate($request->input('pageSize'));

        return $this->success($this->toPageData($sentences));
    }

    /**
     * 保存
     *
     * @param StoreSentenceRequest $request
     * @return JsonResponse
     */
    public function store(StoreSentenceRequest $request): JsonResponse
    {
        $attributes = $request->post();

        Sentence::query()->create($attributes);

        return $this->success();
    }

    /**
     * 更新
     *
     * @param StoreSentenceRequest $request
     * @param Sentence $sentence
     * @return JsonResponse
     */
    public function update(StoreSentenceRequest $request, Sentence $sentence): JsonResponse
    {
        $attributes = $request->post();
        $sentence->fill(array_filter_null($attributes))->save();
        return $this->success();
    }

    /**
     * 删除
     *
     * @param Sentence $sentence
     * @return JsonResponse
     */
    public function delete(Sentence $sentence): JsonResponse
    {
        $sentence->delete();
        return $this->success();
    }

}
