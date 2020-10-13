<?php

namespace App\Lib;

/**
 * Class Load
 * @package App\Lib
 */
class Load
{
    /**
     * @var HttpRequest
     */
    public $httpRequest;

    /**
     * @var Redis
     */
    public $redis;

    /**
     * Load constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->httpRequest = new HttpRequest();
        $this->redis = new Redis();
    }
}