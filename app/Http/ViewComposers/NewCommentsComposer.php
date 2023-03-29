<?php


namespace App\Http\ViewComposers;

use App\Models\Comment;
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
        $newComments = Comment::query()->where(['commentable_type' => 'App\Models\Guestbook', 'parent_id' => 0])->limit(6)->orderByDesc('id')->get();
        $view->with('newComments', $newComments);
    }
}
