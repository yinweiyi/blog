<?php


namespace App\Vendors\Redis;


class VisitStatistics extends GetSet
{
    protected string $namespace = 'visit_statistics';

    /**
     * @param string $key
     * @return int
     */
    public function visit(string $key = 'total'): int
    {
        $key = $this->getKey($key);
        return $this->redis->incr($key);
    }
}
