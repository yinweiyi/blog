<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoriesComposer;
use App\Http\ViewComposers\ConfigsComposer;
use App\Http\ViewComposers\FriendshipLinksComposer;
use App\Http\ViewComposers\HotsComposer;
use App\Http\ViewComposers\NewCommentsComposer;
use App\Http\ViewComposers\SentenceComposer;
use App\Http\ViewComposers\TagsComposer;
use App\Http\ViewComposers\VisitComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{

    protected array $composers = [
        ConfigsComposer::class         => ['layouts.footer', 'layouts.nav', 'master'],
        TagsComposer::class            => 'layouts.tags',
        CategoriesComposer::class      => 'layouts.nav',
        HotsComposer::class            => 'layouts.hots',
        FriendshipLinksComposer::class => 'layouts.friendship_links',
        NewCommentsComposer::class     => 'layouts.newest_comments',
        SentenceComposer::class        => 'home.index',
        VisitComposer::class           => 'layouts.footer',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->composers as $class => $views) {
            View::composer($views, $class);
        }
    }
}
