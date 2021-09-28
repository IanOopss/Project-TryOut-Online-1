<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class JenisSoal extends Admin
{   
    public function index()
	{
		$data['title'] 	= "Jenis Soal";
		$data['page'] 		= "jenis_soal";
		
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll();

		return view('v_admin/v_app', $data);
	}

	public function inputSoal()
	{
		$nama_soal 			= ucwords($this->request->getVar('nama_soal'));
		$jumlah_soal	 	= $this->request->getVar('jumlah_soal');
		$minimal_benar	 	= $this->request->getVar('minimal_benar');
		
		// if ($jumlah_soal<$minimal_benar) {
		// 	$this->session->set_flashdata('warning', 'Data Gagal Disimpan!. <br> Jumlah Soal harus lebih besar dari jumlah minimal soal yang benar');
		// 	return redirect()->to('Admin/JenisSoal');
		// }

        $data = [
            'nama_soal'     => $nama_soal,
            'jumlah_soal' 	=> $jumlah_soal,
            'minimal_benar' => $minimal_benar,
            'total_nilai' 	=> $jumlah_soal*5,
            'passing_grade' => $minimal_benar*5
        ];

        $this->soal->insert($data);

        return redirect()->to('Admin/JenisSoal');
	}

	public function editSoal($id)
	{
		$nama_soal 			= ucwords($this->request->getVar('nama_soal'));
		$jumlah_soal	 	= $this->request->getVar('jumlah_soal');
		$minimal_benar	 	= $this->request->getVar('minimal_benar');
		
		// if ($jumlah_soal<$minimal_benar) {
		// 	$this->session->set_flashdata('warning', 'Data Gagal Diperbarui!. <br> Jumlah Soal harus lebih besar dari jumlah minimal soal yang benar');
		// 	return redirect()->to('Admin/JenisSoal');
		// }
        
        $data = [
            'nama_soal'  => $nama_soal,
            'jumlah_soal' 	=> $jumlah_soal,
            'minimal_benar' 	=> $minimal_benar,
            'total_nilai' 	=> $jumlah_soal*5,
            'passing_grade' 	=> $minimal_benar*5
            ];

        $this->soal->update($id, $data);
        
        return redirect()->to('Admin/JenisSoal');
    }

	public function deleteSoal($id)
	{
	    $this->soal->delete($id);
		return redirect()->to('Admin/JenisSoal');
	}
}