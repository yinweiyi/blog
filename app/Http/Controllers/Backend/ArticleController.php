<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * 列表
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $articles = Article::query()
            ->with(['tags', 'category'])
            ->orderByDesc('is_top')
            ->orderByDesc('order')
            ->paginate($request->input('pageSize'));

        return $this->success($this->toPageData($articles));
    }

    /**
     * 详情
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function detail(Article $article): JsonResponse
    {
        $article->setRelation('tags', $article->tags()->pluck('id'));
        return $this->success($article);
    }

    /**
     * 保存
     *
     * @param StoreArticleRequest $request
     * @return JsonResponse
     */
    public function store(StoreArticleRequest $request): JsonResponse
    {
        $attributes = $request->post();

        /**
         * @var Article $article
         */
        $article = Article::query()->create($attributes);

        $article->tags()->sync($attributes['tags'] ?? []);

        return $this->success();
    }

    /**
     * 更新
     *
     * @param StoreArticleRequest $request
     * @param Article $article
     * @return JsonResponse
     */
    public function update(StoreArticleRequest $request, Article $article): JsonResponse
    {
        $attributes = $request->post();
        $article->fill(array_filter_null($attributes))->save();
        $article->tags()->sync($attributes['tags'] ?? []);
        return $this->success();
    }


    /**
     * 更新部分
     *
     * @param StoreArticleRequest $request
     * @param Article $article
     * @return JsonResponse
     */
    public function updateStatus(Request $request, Article $article): JsonResponse
    {
        $attributes = $request->only(['is_show', 'is_top']);
        $article->fill(array_filter_null($attributes))->save();
        return $this->success();
    }

    /**
     * 删除
     *
     * @param Article $article
     * @return JsonResponse
     */
    public function delete(Article $article): JsonResponse
    {
        $article->delete();
        return $this->success();
    }

}
