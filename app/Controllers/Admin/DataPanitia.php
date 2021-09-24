<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DataPanitia extends BaseController
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
		$username 		= $this->input->post('username');
		$nama			= ucwords($this->input->post('nama'));
		$level_admin 	= "2";
		$password 		= $this->encryption->encrypt($username);

		$data = [
				'username' => $username,
				'password ' => $password,
				'level_admin' => $level_admin,
				'nama' => $nama,
			];

		$simpan = $this->panitia->input_panitia($data);

		if (!$simpan) {
			$this->session->set_flashdata('success', 'Data Panitia Berhasil Disimpan.');
		} else{
			$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
		}
		redirect('data_panitia');
	}

	public function edit($id_admin)
	{
		$nama			= ucwords($this->input->post('nama'));

		$data = [
				'nama' => $nama
			];

		$simpan = $this->panitia->update_panitia($data, $id_admin);

		if (!$simpan) {
			$this->session->set_flashdata('info', 'Data Panitia Berhasil Diperbarui.');
		} else{
			$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
		}
		redirect('data_panitia');
	}

	public function delete($id_admin)
	{

		$simpan = $this->panitia->delete_panitia($id_admin);

		if (!$simpan) {
			$this->session->set_flashdata('danger', 'Data Panitia Berhasil Dihapus.');
		} else{
			$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
		}
		redirect('data_panitia');
	}
}