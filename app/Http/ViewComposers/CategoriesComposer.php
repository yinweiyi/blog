<?php


namespace App\Http\ViewComposers;

use App\Models\Category;
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
        $categories = Category::query()->orderBy('order')->select('id', 'parent_id', 'name', 'slug')->get();
        $categories = unlimited_for_layer($categories);
        $view->with('categories', $categories);
    }
}
