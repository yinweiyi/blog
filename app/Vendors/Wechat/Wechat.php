<?php

namespace App\Vendors\Wechat;

use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\OfficialAccount\Application;
use Illuminate\Support\Facades\Cache;

class Wechat
{

    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getOfsApplication(): Application
    {
        $application =  new Application($this->config);

        $application->setCache(Cache::store('redis'));

        return $application;
    }
}
