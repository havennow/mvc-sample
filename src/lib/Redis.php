<?php

namespace App\Lib;

/**
 * Class Redis
 * @package App\Lib
 */
class Redis
{
    /**
     * @var
     */
    private static $instance;
    /**
     * @var \Redis
     */
    private $connection;

    /**
     * Redis constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $config = require __DIR__.'/../config/config.php';
        $host = '127.0.0.1';
        $port = '6379';

        if (isset($config['redis_host']) && isset($config['redis_port'])) {
            $host = $config['redis_host'];
            $port = $config['redis_port'];
        }

        try {
            $this->connection = new \Redis();
            $this->connection->connect($host, $port);

        }catch (\Exception $e) {
            View::Render(['error' => $e], 'error/index');
        }
    }

    /**
     * @return Redis
     * @throws \Exception
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @return \Redis
     */
    public function getConnection()
    {
        return $this->connection;
    }
}