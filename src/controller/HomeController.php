<?php

namespace App\Controller;

use App\Lib\HttpRequest;
use App\Lib\View;
use App\Lib\Redis;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController
{
    /**
     * @param HttpRequest $request
     * @throws \Exception
     */
    public function index(HttpRequest $request)
    {
        $result = null;
        $cached = null;

        if ($request->getMethod() == 'GET') {
            $redis = Redis::getInstance()->getConnection();
            $cached = $redis->get('home_cache');

            if (!$cached) {
                $cached = View::Render(['host' => $request->getHost()], 'home/index');
                $redis->set('home_cache', base64_encode($cached), 3600);
            }else{
                $cached = base64_decode($cached);
            }
        }

        echo $cached;
    }
}
