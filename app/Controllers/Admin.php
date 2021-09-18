<?php
namespace App\Controllers;

class Admin extends BaseController
{
	public function index()
	{
		$data ['title'] 	= "Dashboard Admin";
		$data ['page'] 		= "dashboard_admin";
		
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll();

		$data['data_panitia'] = $this->admin->countAllResults();
		$data['lab'] = $this->lab->countAllResults();
		$data['soal'] = $this->soal->countAllResults();
		$data['pertanyaan'] = $this->pertanyaan->countAllResults();
		$data['peserta'] = $this->peserta->countAllResults();
		
		return view('v_admin/v_app', $data);
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}