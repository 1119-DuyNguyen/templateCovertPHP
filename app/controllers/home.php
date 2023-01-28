<?php
//class/ function case-insensitive
class Home extends Controller
{

    public function index()
    {
        $this->view("minima/header", ['page_title' => "Home"]);
        $images_thumbnail = [];

        $imageClass = $this->loadModel("image");

        $data = $imageClass->getAll();
        if ($data) {
            //     \myFuncs\show($data);
            foreach ($data as $key => $value) {
                $data[$key]->image = $imageClass->get_thumbnail($value->image);
            }
            $images_thumbnail = $data;
        }


        $this->view("minima/home", ['images_user' => $images_thumbnail]);

        $this->view("minima/footer");
    }
    //chi tiết của hình ảnh (image ) đó
    public function detail($params = "")
    {
        $isExist = false;

        if (isset($params[0])) {
            $numberUnhash = \myFuncs\unHashNumber($params);

            $imageClass = $this->loadModel("image");
            //$numberUnhash = id


            $data = $imageClass->getOne($numberUnhash);

            if ($data) {
                $this->view("minima/header", ['page_title' => "Detail"]);
                $this->view("minima/detail_image", ['dataImage' => $data]);
                $this->view("minima/footer");
                $isExist = true;
            }

        }
        if (!$isExist) {
            header("Location:" . ROOT . "home");
        }

    }
}