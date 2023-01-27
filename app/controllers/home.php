<?php
//class/ function case-insensitive
class Home extends Controller
{

    public function index()
    {


        $this->view("minima/header", ['page_title' => "Home"]);
        $images_user = [];
        if (isset($_SESSION['user_id'])) {
            $imageClass = $this->loadModel("image");

            $data = $imageClass->getAll();
            if ($data) {
                $images_user = $data;
            }
        }

        $this->view("minima/home", ['images_user' => $images_user]);

        $this->view("minima/footer");
    }
}