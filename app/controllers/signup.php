<?php
//class/ function case-insensitive
class SignUp extends Controller
{

    public function index()
    {


        //$thiss= 

        if (isset($_POST['email'])) {
            $user = $this->loadModel("user");
            $user->signup();

        } else if (isset($_POST['username'])) {

            $user = $this->loadModel("user");
            $user->login();
        }
        $this->view("minima/header", ['page_title' => "Sign up"]);

        $this->view("minima/signup");

        $this->view("minima/footer");
    }
}