<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_soal extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('level_admin'))
		{
			redirect('access_denied');
		}
	}

	public function index()
	{
		$data ['title'] 	= "Jenis Soal";
		$data ['page'] 		= "jenis_soal";

		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();
		
		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] = $this->M_jenis_soal->data_jenis_soal()->result();
		$this->load->view('v_admin/v_app', $data);
	}

	public function input()
	{
		$nama_soal 			= ucwords($this->input->post('nama_soal'));
		$jumlah_soal	 	= $this->input->post('jumlah_soal');
		$minimal_benar	 	= $this->input->post('minimal_benar');
		
		if ($jumlah_soal<$minimal_benar) {
			$this->session->set_flashdata('warning', 'Data Gagal Disimpan!. <br> Jumlah Soal harus lebih besar dari jumlah minimal soal yang benar');
			redirect('jenis_soal');
		}

		else{
			$data = [
				'nama_soal'  => $nama_soal,
				'jumlah_soal' 	=> $jumlah_soal,
				'minimal_benar' 	=> $minimal_benar,
				'total_nilai' 	=> $jumlah_soal*5,
				'passing_grade' 	=> $minimal_benar*5
				];

			$simpan = $this->M_jenis_soal->input_jenis_soal($data);

			if (!$simpan) {
				$this->session->set_flashdata('success', 'Data Jenis Soal Berhasil Disimpan.');
			} else{
				$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
			}
			redirect('jenis_soal');
		}
		
	}

	public function edit($id_soal)
	{
		$nama_soal 			= ucwords($this->input->post('nama_soal'));
		$jumlah_soal	 	= $this->input->post('jumlah_soal');
		$minimal_benar	 	= $this->input->post('minimal_benar');
		
		if ($jumlah_soal<$minimal_benar) {
			$this->session->set_flashdata('warning', 'Data Gagal Diperbarui!. <br> Jumlah Soal harus lebih besar dari jumlah minimal soal yang benar');
			redirect('jenis_soal');
		}
		else{
			$data = [
				'nama_soal'  => $nama_soal,
				'jumlah_soal' 	=> $jumlah_soal,
				'minimal_benar' 	=> $minimal_benar,
				'total_nilai' 	=> $jumlah_soal*5,
				'passing_grade' 	=> $minimal_benar*5
				];

			$simpan = $this->M_jenis_soal->update_jenis_soal($data, $id_soal);

			if (!$simpan) {
				$this->session->set_flashdata('info', 'Data Jenis Soal Berhasil Diperbarui.');
			} else{
				$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
			}
			redirect('jenis_soal');
		}
		
	}

	public function delete($id_soal)
	{
		$simpan = $this->M_jenis_soal->delete_jenis_soal($id_soal);

		if (!$simpan) {
			$this->session->set_flashdata('danger', 'Data Berhasil Dihapus.');
		} else{
			$this->session->set_flashdata('warning', 'Data Gagal Dihapus');
		}
		redirect('jenis_soal');
	}

}
