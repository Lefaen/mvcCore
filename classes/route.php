<?php

class route
{
    private static $url = null;

    /*public static function getUrl(){
        return self::$url;
    }*/

    public static function setUrl($url)
    {
        //prepare
        self::$url = $url;
    }


    static function start()
    {
        self::setUrl($_SERVER['REQUEST_URI']);
        $url = self::$url;

        $url = explode('?', $url);
        $url = $url[0];
        $url = str_replace('/', '', $url);


        if (file_exists('pages/' . $url) && !empty($url)) {
            require_once "pages/$url/index.php";
        } elseif(!file_exists('pages/' . $url)) {
            self::error404();
        }
    }

    static function error404()
    {
        print_r('ERROR_404');
    }
}