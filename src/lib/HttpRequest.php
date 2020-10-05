<?php

namespace App\Lib;

/**
 * Class HttpRequest
 * @package App\Lib
 */
class HttpRequest
{
    /**
     * @var
     */
    private $uri;
    /**
     * @var
     */
    private $method;
    /**
     * @var
     */
    private $request;
    /**
     * @var
     */
    private $path;
    /**
     * @var
     */
    private $function;
    /**
     * @var array
     */
    private $params = [];
    /**
     * @var string
     */
    public $defaultRoute = 'index';
    /**
     * @var string
     */
    public $defaultController = 'home';
    /**
     * @var
     */
    private $config;

    /**
     * HttpRequest constructor.
     */
    public function __construct()
    {
        $this->init();
        $this->exec();
    }

    /**
     * @throws \Exception
     */
    private function exec()
    {
        try {
            switch ($this->method) {
                case 'GET':
                    $this->executeGet();
                    break;
                case 'POST':
                    $this->executePost();
                    break;
            }
        }catch(\Exception $e){
            echo View::Render(['error' => $e], 'error/index');
        }
    }

    /**
     *
     */
    private function init()
    {
        $this->config = require __DIR__.'/../config/config.php';
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->clearVariable('/(^\/\w+\-\w+)|(^\/\w+)/i', $this->uri, $this->path);
        $this->clearVariable('/\/\w+$/i', $this->uri, $this->function);

        if ($this->function === $this->path || empty($this->function)) {
            $this->function = $this->config['default_route'] ?? $this->defaultRoute;
        }

        $this->path  = preg_replace_callback("/-[a-zA-Z]/", function($matches) {
            return ucfirst($matches[0][1]);
        }, ucfirst($this->path));

        $this->request = $_REQUEST;
        $this->params = $_SERVER['QUERY_STRING'];
    }

    /**
     * @throws Exception
     */
    private function executeGet()
    {
        $this->init();
        $namespace = '\\App\\Controller\\';
        if (empty($this->path)) {
            $this->path = ucfirst($this->config['default_controller'] ?? $this->defaultController);
        }
        $this->path .= 'Controller';
        $class = $namespace.$this->path;

        if (!class_exists($class)) {
            throw new Exception("Class $class not found");
        }

        $newClass = new $class;

        $this->params = $this->extractParams($this->params);
        $this->params['request'] = $this;

        if (!method_exists($newClass, $this->function)) {
            throw new Exception('Method not found');
        }

        call_user_func_array([
            $newClass,
            $this->function
        ], $this->params);
    }

    /**
     * @param $params
     * @return array
     */
    private function extractParams($params)
    {
        $result = [];
        $params = explode('&', $params);

        if (!empty($params)) {
            foreach ($params as $param) {
                if (!empty($param)) {
                    $_result = explode('=', $param);
                    $result[$_result[0]] = $_result[1];
                }
            }
        }

        return $result;
    }

    /**
     *
     */
    private function executePost()
    {
        //@TODO
    }

    /**
     * @param string $pattern
     * @param $in
     * @param $out
     */
    private function clearVariable(string $pattern, $in, &$out)
    {
        preg_match($pattern, $in, $out);

        if (is_array($out)) {
            $out = str_replace('/', null, end($out));
        }
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
}