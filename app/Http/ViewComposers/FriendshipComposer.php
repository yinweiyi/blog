<?php


namespace App\Http\ViewComposers;

use App\Models\Friendship;
use Illuminate\View\View;

class FriendshipComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $friendships = Friendship::query()->where('status', 1)->orderByDesc('order')->select(['title', 'link'])->get()->chunk(2);
        $view->with('friendships', $friendships);
    }
}
