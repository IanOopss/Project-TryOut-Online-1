<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_panitia extends CI_Controller {

	function __construct() {
		parent::__construct();
		if($this->session->userdata('level_admin') != "1")
		{
			redirect('access_denied');
		}
	}

	public function index()
	{
		$data ['title'] 	= "Data Panitia";
		$data ['page'] 		= "data_panitia";

		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();
		
		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] = $this->M_jenis_soal->data_jenis_soal()->result();
		$data ['data_panitia'] = $this->M_panitia->data_panitia()->result();

		$this->load->view('v_admin/v_app', $data);
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

		$simpan = $this->M_panitia->input_panitia($data);

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

		$simpan = $this->M_panitia->update_panitia($data, $id_admin);

		if (!$simpan) {
			$this->session->set_flashdata('info', 'Data Panitia Berhasil Diperbarui.');
		} else{
			$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
		}
		redirect('data_panitia');
	}

	public function delete($id_admin)
	{

		$simpan = $this->M_panitia->delete_panitia($id_admin);

		if (!$simpan) {
			$this->session->set_flashdata('danger', 'Data Panitia Berhasil Dihapus.');
		} else{
			$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
		}
		redirect('data_panitia');
	}

}