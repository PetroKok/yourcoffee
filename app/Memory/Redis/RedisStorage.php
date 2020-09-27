<?php

namespace App\Memory\Redis;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redis;
use Predis\Response\Status;

class RedisStorage implements IRedisStorage
{
    protected Redis $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function set(string $key, $value, $ttl = 0): void
    {
        $value = $this->formatValue($value);
        $this->redis::set($key, $value, 'EX', $ttl);
    }

    public function get(string $key)
    {
        if(is_null($this->redis::get($key))) return null;
        return Collection::make(json_decode($this->redis::get($key)));
    }

    public function removeKeys(array $keys)
    {
        foreach ($keys as $key) {
            $this->redis::del($key);
        }
    }

    public function flushAll(): Status
    {
        return $this->redis::flushAll();
    }

    private function formatValue($a){
        if(is_string($a)) return $a;
        if(is_array($a)) return json_encode($a);
        return $a;
    }
}
