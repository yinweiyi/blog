<?php


namespace App\Http\ViewComposers;

use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class TagsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $tags = Cache::remember('tags', 3600, function () {
            return Tag::query()->pluck('name', 'slug');
        });
        $view->with('tags', $tags->shuffleWithKey());
    }
}
