<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Carbon::setLocale('zh');
        Paginator::useBootstrap();

        // 只在本地开发环境启用 SQL 日志
        $request = $this->app['request'];
        // 只在本地开发环境启用 SQL 日志
        if (!app()->environment('production')) {
            DB::listen(function ($query) use ($request) {
                Log::info(Str::replaceArray('?', $query->bindings, $query->sql) . ' Times: ' . $query->time . 'ms' . ' Path: ' . $request->path());
            });
        }

        //打乱集合，保留key
        Collection::macro('shuffleWithKey', function ($seed = null) {
            $items = $this->items;
            $keys = array_keys($items);
            $keys = Arr::shuffle($keys, $seed);
            $news = collect();
            foreach ($keys as $key) {
                $news->put($key, $items[$key]);
            }
            return $news;
        });
    }
}
