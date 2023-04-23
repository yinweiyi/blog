<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageModelRequest;
use App\Models\Image;
use App\Models\ImageModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $models = ImageModel::query()->orderByDesc('order')->orderByDesc('id')->get();
        return $this->success($models);
    }

    /**
     * 保存
     *
     * @param StoreImageModelRequest $request
     * @return JsonResponse
     */
    public function store(StoreImageModelRequest $request): JsonResponse
    {
        $attributes = $request->post();

        ImageModel::query()->create($attributes);

        return $this->success();
    }

    /**
     * 更新
     *
     * @param StoreImageModelRequest $request
     * @param ImageModel $imageModel
     * @return JsonResponse
     */
    public function update(StoreImageModelRequest $request, ImageModel $imageModel): JsonResponse
    {
        $attributes = $request->post();
        $imageModel->fill(array_filter_null($attributes))->save();
        return $this->success();
    }

    /**
     * 更新部分
     *
     * @param Request $request
     * @param ImageModel $imageModel
     * @return JsonResponse
     */
    public function updateStatus(Request $request, ImageModel $imageModel): JsonResponse
    {
        $status = (bool)$request->post('status', false);
        $imageModel->fill(compact('status'))->save();
        return $this->success();
    }

    /**
     * 详情
     *
     * @param ImageModel $imageModel
     * @return JsonResponse
     */
    public function detail(ImageModel $imageModel): JsonResponse
    {
        return $this->success($imageModel);
    }

    /**
     * 删除
     *
     * @param ImageModel $imageModel
     * @return JsonResponse
     */
    public function delete(ImageModel $imageModel): JsonResponse
    {
        $existsImage = Image::query()->where('image_model_id', $imageModel->id)->exists();
        if ($existsImage) {
            return $this->error('此分类下包含图片，不可删除');
        }

        $imageModel->delete();
        return $this->success();
    }
}
