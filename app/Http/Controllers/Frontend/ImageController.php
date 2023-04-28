<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

}
