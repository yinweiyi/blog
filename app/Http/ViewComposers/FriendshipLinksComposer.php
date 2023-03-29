<?php


namespace App\Http\ViewComposers;

use App\Models\FriendshipLink;
use Illuminate\View\View;

class FriendshipLinksComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $friendshipLinks = FriendshipLink::query()->where('is_enable', 1)->orderByDesc('id')->select(['title', 'link'])->get()->chunk(2);
        $view->with('friendshipLinks', $friendshipLinks);
    }
}
