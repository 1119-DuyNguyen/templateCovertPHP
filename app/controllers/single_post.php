<?php

class Single_post extends Controller
{
	function index($link = '')
	{

		if ($link == "") {

			$data['page_title'] = "Image not found";
			$this->view("minima/not_found", $data);
		} else {

			$posts = $this->loadModel("posts");
			$result = $posts->get_one($link);

			$data['post'] = $result;

			$data['page_title'] = "Single Post";
			$this->view("minima/single_post", $data);
		}
		$this->view("minima/header", ['page_title' => "Home"]);
		$images_thumbnail = [];
		if (isset($_SESSION['user_id'])) {
			$imageClass = $this->loadModel("image");

			$data = $imageClass->getAll();
			if ($data) {
				//     \myFuncs\show($data);
				foreach ($data as $key => $value) {
					$data[$key]->image = $imageClass->get_thumbnail($value->image);
				}
				$images_thumbnail = $data;
			}
		}

		$this->view("minima/home", ['images_user' => $images_thumbnail]);

		$this->view("minima/footer");
	}

}