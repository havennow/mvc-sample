<?php

namespace App\Controller;

use App\Lib\HttpRequest;
use App\Lib\View;

/**
 * Class JavaScriptController
 * @package App\Controller
 */
class JavaScriptController
{
    /**
     * @param HttpRequest $request
     * @throws \Exception
     */
    public function index(HttpRequest $request)
    {
        echo  View::Render([], 'javaScript/index');
    }
}
