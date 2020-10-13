<?php

namespace App\Controller;

use App\Lib\View;

/**
 * Controller Javascript
 *
 * Class JavaScriptController
 * @package App\Controller
 */
class JavaScriptController
{
    /**
     * Action of controller "index"
     * @throws \Exception
     */
    public function index()
    {
        echo  View::Render('javaScript/index');
    }
}
