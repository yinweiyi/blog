<?php


namespace App\Http\ViewComposers;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
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
        $hots = Cache::remember('hots', 3600, function () {
            return Article::query()->orderByDesc('views')->limit(10)->select(['slug', 'title'])->get();
        });
        $view->with('hots', $hots);
    }
}
