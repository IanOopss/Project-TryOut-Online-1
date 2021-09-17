<?php
namespace App\Controllers;

class Login extends BaseController
{
	public function index()
	{
		$data ['title'] 	= "Login Peserta";
		$data ['page'] 		= "login_peserta";
		$data ['informasi'] 	= $this->informasi->data_informasi();

		return view('v_login/v_app', $data);
	}

	public function peserta_login()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('comfirm_password', 'Comfirm Password', 'trim|required|min_length[8]|matches[password]');

		if($this->form_validation->run() == FALSE) {

			$data = array(
				'warning' => validation_errors() 
				);

			$this->session->set_flashdata($data);
	
			redirect('login');

		}else{
			$username = $this->input->post('username');
		 	$password = $this->input->post('password');

		 	//Cek Login peserta
			$cek_peserta = $this->peserta->cek_paserta($username);
		
			foreach($cek_peserta as $cu)
			{	
				$user = $cu->nim;
				$pass = $this->encryption->decrypt($cu->password_peserta);
			}
			
			if ($user == "") {
				$this->session->set_flashdata('warning', 'Maaf, NIM Tidak Terdaftar.');
				redirect('login');
			
			}elseif($pass != $password){
				$this->session->set_flashdata('warning', 'Maaf, Password Yang Anda Masukan Salah.');
				redirect('login');;
			}elseif ($pass == $password) {

				$cek_peserta = $this->peserta->cek_paserta($username);
				foreach($cek_peserta as $sess){
					$id_peserta 	= $sess->id_peserta;
					$id_lab			= $sess->id_lab;
					$nim 			= $sess->nim;
					$nama_peserta 	= $sess->nama_peserta;
				}

				$user_data = array(
					'id_peserta' 		=> $id_peserta,
					'id_lab' 		=> $id_lab,
					'nim' 		=> $nim,
					'nama_peserta' 	=> $nama_peserta
					);
				$this->session->set_userdata($user_data);
				
				redirect('peserta');
	
			}else{

				$this->session->set_flashdata('warning', 'Maaf, kombinasi username dan password salah.');
				redirect('login');
			}
		}
	}

	public function panitia()
	{
		$data ['title'] 	= "Login Panitia";
		$data ['page'] 		= "login_panitia";
		$data ['informasi'] 	= $this->informasi->data_informasi();
		
        return view('v_login/v_app', $data);
	}

	public function panitia_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('comfirm_password', 'Comfirm Password', 'trim|required|min_length[8]|matches[password]');

		if($this->form_validation->run() == FALSE) {

			$data = array(
				'warning' => validation_errors() 
				);

			$this->session->set_flashdata($data);
	
			redirect('login/panitia');

		}else{
			$username = $this->input->post('username');
		 	$password = $this->input->post('password');

		 	//Cek Login Panitia
			$cek_panitia = $this->admin->cek_panitia($username);
		
			foreach($cek_panitia as $cu)
			{	
				$user = $cu->username;
				$pass = $this->encryption->decrypt($cu->password);
			}
			//echo $user." ".$pass;
			if ($user == "") {
				$this->session->set_flashdata('warning', 'Maaf, Panitia Tidak Terdaftar.');
				redirect('login/panitia');
			
			}elseif($pass != $password){
				$this->session->set_flashdata('warning', 'Maaf, Password Yang Anda Masukan Salah.');
				redirect('login/panitia');
			}elseif ($pass == $password) {

				$cek_panitia = $this->admin->cek_panitia($username);
				foreach($cek_panitia as $sess){
					$id_admin 		= $sess->id_admin;
					$username 		= $sess->username;
					$password 		= $sess->password;
					$level_admin 	= $sess->level_admin;
					$nama 			= $sess->nama;
				}

				$user_data = array(
					'id_admin' 		=> $id_admin,
					'username' 		=> $username,
					'password' 		=> $password,
					'level_admin' 	=> $level_admin,
					'nama' 			=> $nama
					);
				$this->session->set_userdata($user_data);

				if ($level_admin == '1') {
					redirect('admin');
				}elseif ($level_admin == '2') {
					redirect('panitia');
				}else{
					redirect('access_denied');
				}
			
			}else{

				$this->session->set_flashdata('warning', 'Maaf, kombinasi username dan password salah.');
				redirect('login/panitia_login');
			}
		}
	}
}