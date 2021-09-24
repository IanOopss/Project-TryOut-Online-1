<?php
namespace App\Controllers;

class Peserta extends BaseController
{
	public function index()
	{
		$data ['title'] 	= "Dashboard Peserta";
		$data ['page'] 		= "dashboard_peserta";
		$data ['informasi'] 	= $this->informasi->findAll();

		$data ['peserta']	= $this->peserta->find(session()->get('id_peserta'));

		// Data Jawaban
		$data ['jawaban'] 	= $this->jawaban->countAllResults();
		$data ['data_jawaban'] 	= $this->jawaban->findAll();

		//Nilai Peserta
		$data ['data_nilai'] 	= $this->nilai->findAll();

		$this->load->view('v_peserta/v_app', $data);
	}

	public function test(){
		dd('test');
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}