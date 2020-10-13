<?php

namespace App\Lib;

/**
 * Class View
 * @package App\Lib
 */
class View
{
    /**
     * Render data in view
     *
     * @param $file
     * @param $data
     * @return null|string
     * @throws \Exception
     */
    public static function Render($file, $data = [])
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
