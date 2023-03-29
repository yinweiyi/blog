<?php


namespace App\Http\ViewComposers;

use App\Models\Article;
use Illuminate\View\View;

class HotsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('hots', Article::query()->orderByDesc('views')->limit(10)->select(['slug', 'title'])->get());
    }
}
