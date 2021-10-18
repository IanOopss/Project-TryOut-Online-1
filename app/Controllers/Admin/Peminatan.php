<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class Peminatan extends Admin {
	public function index()
	{
		$this->data['title'] 	= "Peminatan";
		$this->data['page'] 		= "peminatan";
		
		return view('v_admin/v_app', $this->data);
	}

	public function inputPeminatan()
	{
		$nama_peminatan 	= ucwords($this->request->getVar('nama_peminatan'));
		$waktu_pengerjaan 	= $this->request->getVar('waktu_pengerjaan');

        $data = array(
            'nama_peminatan'       => $nama_peminatan,
            'waktu_pengerjaan' => $waktu_pengerjaan,
        );

        $this->peminatan->insert($data);

        return redirect()->to('Admin/Peminatan');
	}

	public function editPeminatan($id)
	{
		$nama_peminatan 	= ucwords($this->request->getVar('nama_peminatan'));
		$waktu_pengerjaan 	= $this->request->getVar('waktu_pengerjaan');

        $data = array(
            'nama_peminatan'       => $nama_peminatan,
            'waktu_pengerjaan' => $waktu_pengerjaan,
        );
        
        $this->peminatan->update($id, $data);

        return redirect()->to('Admin/Peminatan');
	}

	public function deletePeminatan($id)
	{
		$this->peminatan->delete($id);

		return redirect()->to('Admin/Peminatan');
	}
}
