<?php

class About extends Controller
{
	function index()
	{
		$this->view("minima/header", ['page_title' => "About"]);

		$this->view("minima/about-us");

		$this->view("minima/footer");
	}
}
