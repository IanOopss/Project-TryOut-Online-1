<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
		if($this->session->userdata('level_admin') != "1")
		{
			redirect('access_denied');
		}
	}

	public function index()
	{
		$data ['title'] 	= "Dashboard Admin";
		$data ['page'] 		= "dashboard_admin";

		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();

		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] = $this->M_jenis_soal->data_jenis_soal()->result();

		$data ['data_panitia'] = $this->M_panitia->data_panitia()->num_rows();
		$data ['lab'] = $this->M_formasi_lab->data_formasi_lab()->num_rows();
		$data ['soal'] = $this->M_jenis_soal->data_jenis_soal()->num_rows();
		$data ['pertanyaan'] = $this->M_pertanyaan->tot_pertanyaan()->num_rows();
		$data ['peserta'] = $this->M_peserta->tot_peserta()->num_rows();

		$this->load->view('v_admin/v_app', $data);
	}

	public function edit() 
	{
		/*$nama = "Bang Ambo";
		$username = "admin";
		$password = "admin123";
		$level_admin = 1;
		$data = [ 
			'username' => $username,
			'password' => $this->encryption->encrypt($password),
			'level_admin' => $level_admin,
			'nama' => $nama

			];
		$this->db->insert('tbl_admin', $data);*/

		$data ['title'] 	= "Admin Settings";
		$data ['page'] 		= "admin_edit";

		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();
		
		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] = $this->M_jenis_soal->data_jenis_soal()->result();
		
		$this->load->view('v_admin/v_app', $data);
	}

	public function edit_password($id_admin)
	{

		$this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('comfirm_password', 'Comfirm Password', 'trim|required|min_length[8]|matches[new_password]');
		
		if($this->form_validation->run() == FALSE) {

			$data = array(
				'warning' => validation_errors() 
				);

			$this->session->set_flashdata($data);
	
			redirect('admin/edit');

		}else{

		 	$password 	= $this->input->post('new_password');

		 	$data = array(
			'password' => $this->encryption->encrypt($password)
			);

			$simpan = $this->M_panitia->update_panitia($data, $id_admin);		
			
			if(!$simpan) {
				$this->session->set_flashdata('success', 'Password Berhasil diperbarui.');
				redirect('admin');
			} else {
				$this->session->set_flashdata('warning', 'Password Gagal diperbarui.');
				redirect('admin');
			}
 			
 		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
