<?php

class Contact extends Controller
{
	function index()
	{
		$this->view("minima/header", ['page_title' => "Contact Us"]);

		$this->view("minima/contact");

		$this->view("minima/footer");
	}
}
