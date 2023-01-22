<?php
/*
This class is responsible for handling HTTP requests 
and providing an easy way to access request data.
*/
/*code example */

class Request
{
    // public static function uri()
    // {
    //     return trim(
    //         parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
    //         '/'
    //     );
    // }

    // public static function method()
    // {
    //     return $_SERVER['REQUEST_METHOD'];
    // }
    public static function splitURL(): array
    {
        $url = (isset($_GET['url']))
            ? explode("/", filter_var(trim($_GET['url'], "/"), FILTER_SANITIZE_URL))
            : array("home");

        return $url;
    }
}
