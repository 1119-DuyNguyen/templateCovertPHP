<?php
//class/ function case-insensitive
class Login extends Controller
{

    public function index()
    {

        if (isset($_POST['email'])) {
            $user = $this->loadModel("user");
            $user->signup();

        } else if (isset($_POST['username'])) {

            $user = $this->loadModel("user");
            $user->login();
        }

        $this->view("minima/header", ['page_title' => "Login"]);

        $this->view("minima/login");

        $this->view("minima/footer");
    }
}