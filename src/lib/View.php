<?php

namespace App\Lib;

/**
 * Class Lib
 * @package App\Lib
 */
class View
{
    /**
     * @param $data
     * @param $file
     * @return null|string
     * @throws \Exception
     */
    public static function Render($data, $file)
    {
        $path = realpath(__DIR__.'/../view/');
        $file = $path.'/'.$file.'.php';

        if (!file_exists($file)) {
            throw new Exception('View not found');
        }

        $content = null;
        extract($data);
        ob_start();

        include($file);
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
