<?php
class Upload extends Controller
{
    public function index()
    {

        if (isset($_SESSION['user'])) {
            if (isset($_POST['title']) && isset($_FILES['file'])) {
                $post = $this->loadModel('image');
                $post->upload($_POST, $_FILES);

            }
            // \myFuncs\show($_SESSION['user']);
            $this->view("minima/header", ['page_title' => "Upload"]);

            $this->view("minima/upload");

            $this->view("minima/footer");
        } else {
            header("Location:" . ROOT . "login");
            die;
        }

    }
}