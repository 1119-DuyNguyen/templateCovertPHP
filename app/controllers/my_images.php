<?php
class MyImages extends Controller
{

    /**
     * @return mixed
     */
    public function index()
    {
        $this->view("minima/header", ['page_title' => "My Images"]);
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