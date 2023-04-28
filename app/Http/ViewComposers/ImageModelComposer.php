<?php


namespace App\Http\ViewComposers;

use App\Models\ImageModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ImageModelComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $imageModels = Cache::remember('image_models', 3600, function () {
            return ImageModel::query()->orderByDesc('order')->select('id', 'name')->get();
        });
        $view->with('imageModels', $imageModels);
    }
}
