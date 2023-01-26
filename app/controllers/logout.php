<?php
//class/ function case-insensitive
class Logout extends Controller
{

    public function index()
    {


        unset($_SESSION['user_name']);

        header("Location:" . ROOT . "home");
        exit();


        //$thiss= 


    }

}