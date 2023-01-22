<?php
//class/ function case-insensitive
class Home extends Controller
{

    public function index()
    {
        $this->data['page_title'] = "home";

        //$thiss= 
        $this->view("minima/header", ['page_title' => "Home"]);

        $this->view("minima/home");

        $this->view("minima/footer");
    }
}
