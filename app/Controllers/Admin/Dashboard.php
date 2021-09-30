<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class Dashboard extends Admin
{
	public function index()
	{
		$this->data['title'] 	= "Dashboard Admin";
		$this->data['page'] 		= "dashboard_admin";

		$this->data['data_panitia'] = $this->admin->countAllResults();
		$this->data['jumlah_peminatan'] = $this->peminatan->countAllResults();
		$this->data['soal'] = $this->soal->countAllResults();
		$this->data['pertanyaan'] = $this->pertanyaan->countAllResults();
		$this->data['peserta'] = $this->peserta->countAllResults();
		
		return view('v_admin/v_app', $this->data);
	}
}