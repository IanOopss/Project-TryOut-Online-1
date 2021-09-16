<?php
namespace App\Controllers;

class Access_denied extends BaseController
{
	public function index()
	{
		$data ['title'] 	= "Access Denied";
		$data ['page'] 		= "access_denied";

		return view('v_errors/v_app', $data);
	}
}