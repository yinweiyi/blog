<?php

namespace App\Providers;

use App\Vendors\Wechat\Wechat;
use Illuminate\Support\ServiceProvider;


class WechatProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('wechat', function ($app) {
            return new Wechat($app->config->get('wechat'));
        });

        $this->app->singleton('wechat.ofa', function () {
            return app('wechat')->getOfsApplication();
        });
    }
}
