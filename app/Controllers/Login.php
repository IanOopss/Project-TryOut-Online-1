<?php
namespace App\Controllers;

class Login extends BaseController
{
	public function index()
	{
		$data['title'] 	= "Login Peserta";
		$data['page'] 		= "login_peserta";
		$data['informasi'] 	= $this->informasi->findAll();

		return view('v_login/v_app', $data);
	}

	public function peserta_login()
	{
		if(!$this->validate([
			'username' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Username masih kosong',
				]
			],
			'password' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Password masih kosong',			
				]
			],
		])) {
			return redirect()->to('login')->withInput();
		}

		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		//Cek Login peserta
		$cek_peserta = $this->peserta->cek_peserta($username);

		$user = $cek_peserta['nim'];
		$pass_verify = password_verify($password, $cek_peserta['password_peserta']);

		if ($user == "") {
			session()->set_flashdata('warning', 'Maaf, NIM Tidak Terdaftar.');
			return redirect()->to('login');
		
		}elseif(!$pass_verify){
			session()->set_flashdata('warning', 'Maaf, Password Yang Anda Masukan Salah.');
			return redirect()->to('login');
		}elseif ($pass_verify) {
			$cek_peserta = $this->peserta->cek_peserta($username);
			
			$user_data = array(
				'id_peserta' 	=> $cek_peserta['id_peserta'],
				'id_lab' 		=> $cek_peserta['id_lab'],
				'nim' 			=> $cek_peserta['nim'],
				'nama_peserta' 	=> $cek_peserta['nama_peserta'],
				'isLoggedIn' 	=> TRUE
			);

			session()->set($user_data);
			
			return redirect()->to('peserta');
		}else{
			session()->set_flashdata('warning', 'Maaf, kombinasi username dan password salah.');
			return redirect()->to('login');
		}
	}

	public function panitia()
	{
		$data ['title'] 	= "Login Panitia";
		$data ['page'] 		= "login_panitia";
		$data ['informasi'] 	= $this->informasi->findAll();
		
        return view('v_login/v_app', $data);
	}

	public function panitia_login()
	{
		if(!$this->validate([
			'username' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Username masih kosong',
				]
			],
			'password' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Password masih kosong',			
				]
			],
		])) {
			return redirect()->to('login/panitia')->withInput();
		}

		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		// dd($this->encryption->encrypt(base64_encode('admin123')));
		//Cek Login Panitia
		$cek_panitia = $this->admin->cek_panitia($username);
		$pass_verify = password_verify($password, $cek_panitia['password']);
		
		$user = $cek_panitia['username'];
		
		if ($user == "") {
			session()->set_flashdata('warning', 'Maaf, Panitia Tidak Terdaftar.');
			return redirect()->to('login/panitia');
		}elseif(!$pass_verify){
			session()->set_flashdata('warning', 'Maaf, Password Yang Anda Masukan Salah.');
			return redirect()->to('login/panitia');
		}elseif ($pass_verify) {
			$cek_panitia = $this->admin->cek_panitia($username);
			
			$id_admin 		= $cek_panitia['id_admin'];
			$username 		= $cek_panitia['username'];
			$password 		= $cek_panitia['password'];
			$level_admin 	= $cek_panitia['level_admin'];
			$nama 			= $cek_panitia['nama'];
			
			$user_data = array(
				'id_admin' 		=> $id_admin,
				'username' 		=> $username,
				'password' 		=> $password,
				'level_admin' 	=> $level_admin,
				'nama' 			=> $nama,
				'isLoggedIn' 	=> TRUE
			);

			session()->set($user_data);
			
			if ($level_admin == '1') {
				return redirect()->to('Admin/Dashboard');
			}elseif ($level_admin == '2') {
				return redirect()->to('panitia');
			}else{
				return redirect()->to('access_denied');
			}
		
		}else{
			session()->set_flashdata('warning', 'Maaf, kombinasi username dan password salah.');
			return redirect()->to('login/panitia');
		}
	}
}