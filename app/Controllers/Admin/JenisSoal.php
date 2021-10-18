<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class JenisSoal extends Admin
{   
    public function index()
	{
		$this->data['title'] 	= "Jenis Soal";
		$this->data['page'] 		= "jenis_soal";
		
		$this->data['kategori_soal'] = $this->soal->joinPeminatan();
		$this->data['tbl_peminatan'] = $this->peminatan->findAll();
		
		return view('v_admin/v_app', $this->data);
	}

	public function inputSoal()
	{
		$nama_soal 			= ucwords($this->request->getVar('nama_soal'));
		$peminatan	 		= $this->request->getVar('peminatan');
		$jumlah_soal	 	= $this->request->getVar('jumlah_soal');

        $data = [
            'nama_soal'     => $nama_soal,
            'id_peminatan'  => $peminatan,
            'jumlah_soal' 	=> $jumlah_soal,
        ];

        $this->soal->insert($data);

        return redirect()->to('Admin/JenisSoal');
	}

	public function editSoal($id)
	{
		$nama_soal 			= ucwords($this->request->getVar('nama_soal'));
		$peminatan	 		= $this->request->getVar('peminatan');
		$jumlah_soal	 	= $this->request->getVar('jumlah_soal');
        
        $data = [
            'nama_soal'  => $nama_soal,
            'id_peminatan'  => $peminatan,	
            'jumlah_soal' 	=> $jumlah_soal,
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