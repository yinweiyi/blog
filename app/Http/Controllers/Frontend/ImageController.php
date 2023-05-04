<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageLikeRequest;
use App\Models\Image;
use App\Models\ImageLike;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $modelId = (int)$request->get('model_id');
        $articles = Image::query()->when($modelId > 0, function ($query) use ($modelId) {
            $query->where('image_model_id', $modelId);
        })->orderByDesc('order')->orderByDesc('id')->paginate($request->input('pageSize', 15));

        return view('image.index', array_merge($this->toPageData($articles), ['modelId' => $modelId]));
    }

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
        })->orderByDesc('order')->orderByDesc('id')->paginate($request->input('pageSize', 15));

        return $this->success($this->toPageData($articles));
    }

    public function like(ImageLikeRequest $request)
    {
        $data = $request->post();
        //找出ip
        $ip = $request->ip();
        $ipLong = ip2long($ip);
        //找出图片
        $image = Image::query()->find($data['image_id']);
        if (null == $image) {
            return $this->error('图片不存在');
        }
        try {
            DB::beginTransaction();
            //判断有无点赞过
            $imageLike = ImageLike::query()
                ->where(['ip' => $ipLong, 'image_id' => $data['image_id'], 'type' => $data['type']])
                ->select('id')
                ->first();

            if (null == $imageLike) {
                ImageLike::query()->create(['ip' => $ipLong, 'image_id' => $data['image_id'], 'type' => $data['type']]);
                $image->increment($data['type']);
            } else {
                $imageLike->delete();
                $image->decrement($data['type']);
            }

            DB::commit();
            return $this->success($image[$data['type']]);
        }catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Like image error:' . $exception->getMessage());
            return $this->error('失败');
        }

    }

}
