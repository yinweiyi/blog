<?php

namespace App\Providers;

use App\Http\ViewComposers\CategoriesComposer;
use App\Http\ViewComposers\FriendshipComposer;
use App\Http\ViewComposers\HotsComposer;
use App\Http\ViewComposers\ImageModelComposer;
use App\Http\ViewComposers\NewCommentsComposer;
use App\Http\ViewComposers\SentenceComposer;
use App\Http\ViewComposers\SettingComposer;
use App\Http\ViewComposers\TagsComposer;
use App\Http\ViewComposers\VisitComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{

    protected array $composers = [
        SettingComposer::class     => ['layouts.footer', 'layouts.nav', 'master'],
        TagsComposer::class        => 'layouts.tags',
        CategoriesComposer::class  => 'layouts.nav',
        ImageModelComposer::class  => 'layouts.nav',
        HotsComposer::class        => 'layouts.hots',
        FriendshipComposer::class  => 'layouts.friendships',
        NewCommentsComposer::class => 'layouts.newest_comments',
        SentenceComposer::class    => 'home.index',
        VisitComposer::class       => 'layouts.footer',
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
