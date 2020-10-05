<?php

namespace App\Lib;

class Load
{
    public $httpRequest;
    public $redis;

    /**
     * Load constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
        $this->redis = new Redis();
    }
}