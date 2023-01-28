<?php
abstract class Controller
{
    /**
     * render view with data
     * @param string $viewName
     * @param array $data
     * @return void
     */
    protected function view($viewName, $data = [])
    {
        extract($data);

        if (file_exists("../app/views/" . $viewName . ".php")) {
            require "../app/views/" . $viewName . ".php";
        } else {
            require "../app/views/404Header.php";
            require "./404.html";
        }
    }
    /**
     * get model object
     * @param string $modalName
     * @return Modal|null  
     */
    protected function loadModel($modalName)
    {
        if (file_exists("../app/models/" . $modalName . ".php")) {
            require "../app/models/" . $modalName . ".php";

            return new $modalName;
        } else {
            return null;
        }
        # code...
    }

    public abstract function index();
}