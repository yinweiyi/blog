<?php


namespace App\Http\ViewComposers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CategoriesComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $categories = Cache::remember('categories', 1800, function () {
            $categories = Category::query()->orderByDesc('order')->select('id', 'parent_id', 'name', 'slug')->get();
            return unlimited_for_layer($categories);
        });

        $view->with('categories', $categories);
    }
}
