<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class DataNilai extends Admin {
	public function formasi($id_lab)
	{
		$data['title'] 	= "Data Nilai";
		$data['page'] 		= "data_nilai";

		//Side Menu
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] 	= $this->soal->findAll();

		// Nama Formasi Lab
		$data['cek_lab'] = $this->lab->where('id_lab', $id_lab)->first();
		
		// Data Nilai
		$data['data_nilai'] = $this->peserta->nilaiPeserta($id_lab);

		$data['hasil'] = $this->nilai->findAll();
		
		return view('v_admin/v_app', $data);
	}

}