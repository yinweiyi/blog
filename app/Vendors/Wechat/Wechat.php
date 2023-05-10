<?php

namespace App\Vendors\Wechat;

use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;
use EasyWeChat\OfficialAccount\Application;

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
        return new Application($this->config);
    }
}
