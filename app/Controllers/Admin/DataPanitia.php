<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class DataPanitia extends Admin
{
	public function index()
	{
		$data['title'] 	= "Data Panitia";
		$data['page'] 		= "data_panitia";
		
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll();
		$data['data_panitia'] = $this->admin->findPanitia();
		
		return view('v_admin/v_app', $data);
	}

	public function input()
	{
		$username 		= $this->request->getVar('username');
		$nama			= ucwords($this->request->getVar('nama'));
		$level_admin 	= "2";
		$password 		= base64_encode($this->encryption->encrypt($username));
			
		$this->admin->insert([
			'username' => $username,
			'password' => $password,
			'level_admin' => $level_admin,
			'nama' => $nama,
		]);

		return redirect()->to('Admin/DataPanitia');
	}

	public function editPanitia($id)
	{
		$nama = ucwords($this->request->getVar('nama'));

		$data = [
			'nama' => $nama,
		];
		
		$this->admin->update($id, $data);

		return redirect()->to('Admin/DataPanitia');
	}

	public function deletePanitia($id)
	{
		$this->admin->delete($id);
		return redirect()->to('Admin/DataPanitia');
	}
}