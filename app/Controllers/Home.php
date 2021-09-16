<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
	{
		$data['title'] 	= "Home";
		$data['page'] 		= "home";
		$data['informasi'] 	= $this->informasi->data_informasi();
		
		return view('v_home/home', $data);
	}
}