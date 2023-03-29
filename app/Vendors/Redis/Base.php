<?php


namespace App\Vendors\Redis;


use Illuminate\Cache\Repository;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Redis\Connections\Connection;
use Illuminate\Redis\Connections\PredisConnection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Psr\SimpleCache\InvalidArgumentException;

abstract class Base
{

    /**
     * @var PredisConnection|Store
     */
    protected PredisConnection|Store $redis;

    /**
     * @var string 空间
     */
    protected string $namespace = 'base';

    /**
     * @var string 前缀
     */
    protected string $prefix = '';

    /**
     * @var string 数据库
     */
    protected string $db = 'default';


    public function __construct($store = null)
    {
        $this->redis = $this->getRedis($store);
    }

    /**
     * 获取key
     *
     * @param $name
     * @return string
     */
    protected function getKey($name = null): string
    {
        return $this->prefix . ':' . $this->namespace . ($name ? ':' . $name : '');
    }

    /**
     * @param null $store
     * @return Connection|null
     */
    protected function getRedis($store = null)
    {
        return $store ? $store : Redis::connection($this->db);
    }

    /**
     * 清除缓存
     *
     * @return bool|int
     * @throws InvalidArgumentException
     */
    public function clear(): bool|int
    {
        $key = $this->getKey();
        $keys = $this->redis->keys($key . '*');
        $prefix = Config::get('database.redis.options.prefix');

        $keys = array_map(function ($key) use ($prefix) {
            return str_replace($prefix, '', $key);
        }, $keys);

        return $this->redis instanceof Repository ? $this->redis->deleteMultiple($keys) : $this->redis->del($keys);
    }
}
