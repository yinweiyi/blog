<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * 列表
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $categories = Category::query()->orderBy('order')->get();

        return $this->success(unlimited_for_layer($categories));
    }

    /**
     * parents
     *
     * @return JsonResponse
     */
    public function parents(): JsonResponse
    {
        $categories = Category::query()->where('parent_id', 0)->select('name', 'id')->get();

        return $this->success($categories);
    }

    /**
     * 保存
     *
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $attributes = $request->post();

        Category::query()->create($attributes);

        return $this->success();
    }

    /**
     * 更新
     *
     * @param StoreCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(StoreCategoryRequest $request, Category $category): JsonResponse
    {
        $attributes = $request->post();
        $category->fill(array_filter_null($attributes))->save();
        return $this->success();
    }

    /**
     * 详情
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function detail(Category $category): JsonResponse
    {
        return $this->success($category);
    }

    /**
     * 删除
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function delete(Category $category): JsonResponse
    {
        $existsChildren = Category::query()->where('parent_id', $category->getAttribute('id'))->exists();
        if ($existsChildren) {
            return $this->error('包含子类，不可删除');
        }

        $existsArticle = Article::query()->where('category_id', $category->id)->exists();
        if ($existsArticle) {
            return $this->error('此分类绑定了文章，不可删除');
        }

        $category->delete();
        return $this->success();
    }

}
