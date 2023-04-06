<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * 详情
     *
     * @param String $key
     * @return JsonResponse
     */
    public function info(String $key): JsonResponse
    {
        $setting = Setting::query()->where('key', $key)->first();
        return $this->success($setting?->value);
    }

    /**
     * 更新
     *
     * @param StoreTagRequest $request
     * @param String $key
     * @return JsonResponse
     */
    public function update(Request $request, String $key): JsonResponse
    {
        $value = $request->post();
        Setting::query()->updateOrCreate(compact('key'), compact('key', 'value'));

        return $this->success();
    }

}
