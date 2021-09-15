<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_denied extends CI_Controller {
	
	public function index()
	{
		$data ['title'] 	= "Access Denied";
		$data ['page'] 		= "access_denied";

		$this->load->view('v_errors/v_app', $data);
	}

}