<?php
abstract class Controller
{
    // data(page_title=>"", post=>"")
    protected $data = [];
    protected function view($name, $data = [])
    {
        extract($data);
        //$data['page_title']->$page_title, for header
        //  require_once "../app/views/{$name}.php";

        if (file_exists("../app/views/" . $name . ".php")) {
            include "../app/views/" . $name . ".php";
        } else {
            include "../app/views/404.php";
        }
    }
    protected function loadModel($name)
    {

        # code...
    }
    /**function 
     * load page
     * @param int $a
     * @param int $b
     * @return int
     */
    public abstract function index();
}
