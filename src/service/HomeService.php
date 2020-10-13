<?php

namespace App\Service;

use App\Lib\Redis;

/**
 * Class HomeService basic for cache
 * @package App\Service
 */
class HomeService
{
    /**
     * Timeout in seconds
     */
    const TIMEOUT = 3600;
    const CACHE_KEY = 'home_cache';

    /**
     * Return cache or in case not set, make cache
     *
     * @param null $byPass
     * @return bool|null|string
     * @throws \Exception
     */
    public static function getCache($byPass = null)
    {
        $redis = Redis::getInstance()->getConnection();
        $cached = $redis->get(self::CACHE_KEY);

        if (!$cached) {
            $cached = $byPass;
            $redis->set(self::CACHE_KEY, base64_encode($cached), self::TIMEOUT);
        }else{
            $cached = base64_decode($cached);
        }

        return $cached;
    }
}
