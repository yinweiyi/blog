<?php


namespace App\Vendors\Redis;


class GetSet extends Base
{

    /**
     * @var string 空间
     */
    protected string $namespace = '';

    /**
     * @param $key
     * @param $value
     * @param $expired
     * @return int
     */
    public function set($key, $value, $expired = null): int
    {
        $key = $this->getKey($key);
        if ($expired) {
            return $this->redis->setex($key, $expired, $value);
        }
        return $this->redis->set($key, $value);
    }

    /**
     * 获取值
     *
     * @param $key
     * @return array
     */
    public function get($key): array
    {
        $key = $this->getKey($key);
        return $this->redis->get($key);
    }

}
