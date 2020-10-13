<?php

namespace App\Controller;

use App\Lib\HttpRequest;
use App\Lib\View;
use App\Service\HomeService;

/**
 * Controller Home
 *
 * Class HomeController
 * @package App\Controller
 */
class HomeController
{
    /**
     * Action of controller  "index"
     *
     * @param HttpRequest $request
     * @throws \Exception
     */
    public function index(HttpRequest $request)
    {
        echo HomeService::getCache(View::Render('home/index', ['host' => $request->getHost()]));
    }
}
