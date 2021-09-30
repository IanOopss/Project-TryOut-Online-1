<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\M_peminatan;
use App\Models\M_soal;

class Admin extends BaseController
{
	public function __construct(){
		$this->peminatan 	= new M_peminatan();
		$this->soal 		= new M_soal();

		$this->data = [
			'peminatan'	=> $this->peminatan->findAll(),
			'jenis_soal' 	=> $this->soal->findAll(),
		];
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}