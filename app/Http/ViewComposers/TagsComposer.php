<?php


namespace App\Http\ViewComposers;

use App\Models\Tag;
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
        $view->with('tags', Tag::query()->pluck('name', 'slug')->shuffleWithKey());
    }
}
