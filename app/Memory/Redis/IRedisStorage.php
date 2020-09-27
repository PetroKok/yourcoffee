<?php


namespace App\Memory\Redis;


interface IRedisStorage
{
    public function set(string $key, $value, $ttl = 0);
    public function get(string $key);
    public function removeKeys(array $keys);
    public function flushAll();
}
