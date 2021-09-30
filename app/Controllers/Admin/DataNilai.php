<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class DataNilai extends Admin {
	public function formasi($id_peminatan)
	{
		$this->data['title'] 	= "Data Nilai";
		$this->data['page'] 		= "data_nilai";

		// Nama Formasi Lab
		$this->data['cek_peminatan'] = $this->peminatan->where('id_peminatan', $id_peminatan)->first();
		
		// Data Nilai
		$this->data['data_nilai'] = $this->peserta->nilaiPeserta($id_peminatan);

		$this->data['hasil'] = $this->nilai->findAll();
		
		return view('v_admin/v_app', $this->data);
	}
}