<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
	{
		$data['title'] 		= "Home";
		$data['page'] 		= "home";
		$data['informasi'] 	= $this->informasi->findAll();
		
		return view('v_home/home', $data);
	}
	
	public function formasi_asisten()
	{
		$data['title'] 			= "Formasi Asisten";
		$data['page'] 				= "formasi_asisten";
		$data['formasi_asisten'] 	= $this->peminatan->findAll();
		
		return view('v_home/pengumuman/formasi_asisten', $data);
	}
	
	public function alur_pendaftaran()
	{
		$data['title'] 	= "Alur Pendaftaran";
		$data['page'] 		= "alur_pendaftaran";
		$data['informasi'] = $this->informasi->findAll();
		
		return view('v_home/pengumuman/alur_pendaftaran', $data);
	}

	public function passing_grade()
	{
		$data['title'] 	= "Passing Grade";
		$data['page'] 		= "passing_grade";
		$data['jenis_soal'] = $this->soal->findAll();
		
		return view('v_home/pengumuman/passing_grade', $data);
	}

	public function about_us()
	{
		$data['title'] 	= "About Us";
		$data['page'] 		= "about_us";
		
		return view('v_home/about_us', $data);
	}
}