<?php


namespace App\Http\ViewComposers;

use App\Models\Comment;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class NewCommentsComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $newComments = Cache::remember('new_comments', 3600, function () {
            return Comment::query()->where(['commentable_type' => 'App\Models\Guestbook', 'parent_id' => 0])->limit(6)->orderByDesc('id')->get();
        });
        $view->with('newComments', $newComments);
    }
}
