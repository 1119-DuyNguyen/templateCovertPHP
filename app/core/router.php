<?php

/*
This class(ROUTER/ some one call App class) is responsible for handling routing,
which is the process of mapping URLs to controllers.
*/
//rule url= public/product/milk ; product = class, milk = method and some parames
/**
 *  process belike : 
 *  get url -> process url ( route)
 */
class Router
{

    private string $controller = "home";
    private string $method = "index"; // method default
    private $params = [];
    public function __construct()
    {

        $url = request::splitURL();

        // create object controller

        if (isset($url[0])) {

            if (file_exists("../app/controllers/" . strtolower($url[0]) . ".php")) {
                $this->controller = strtolower($url[0]);
            }

            unset($url[0]);
        }

        //root là index.php
        require "../app/controllers/" . $this->controller . ".php";
        $controllerObj = new $this->controller;
        // get method object
        if (isset($url[1])) {
            if (method_exists($controllerObj, $url[1])) {
                $this->method = $url[1];
            }
            unset($url[1]);
        }
        //run the class and method
        $this->params = array_values($url);
        call_user_func_array([$controllerObj, $this->method], $this->params);
    }
}