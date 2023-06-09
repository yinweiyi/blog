<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        $modelId = (int)$request->get('model_id');
        $articles = Image::query()->when($modelId > 0, function ($query) use ($modelId) {
            $query->where('image_model_id', $modelId);
        })->orderByDesc('order')->orderByDesc('id')->paginate($request->input('pageSize'));

        return $this->success($this->toPageData($articles));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreImageRequest $request
     * @return JsonResponse
     */
    public function store(StoreImageRequest $request): JsonResponse
    {
        $attributes = $request->post();

        Image::query()->create($attributes);

        return $this->success();
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return JsonResponse
     */
    public function detail(Image $image): JsonResponse
    {
        return $this->success($image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreImageRequest $request
     * @param Image $image
     * @return JsonResponse
     */
    public function update(StoreImageRequest $request, Image $image): JsonResponse
    {
        $attributes = $request->post();
        $image->fill(array_filter_null($attributes))->save();
        return $this->success();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return JsonResponse
     */
    public function delete(Image $image)
    {
        $image->delete();
        return $this->success();
    }
}
