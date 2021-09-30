<?php
namespace App\Controllers;

class Login extends BaseController
{
	public function __construct(){
		$this->data = [
			'validation' => \Config\Services::validation(),
		];
	}

	public function index()
	{
		$this->data['title'] 		= "Login Peserta";
		$this->data['page'] 		= "login_peserta";
		$this->data['informasi'] 	= $this->informasi->findAll();

		return view('v_login/v_app', $this->data);
	}

	public function peserta_login()
	{
		if(!$this->validate([
			'email' => [
				'rules'  => 'required|valid_emails',
				'errors' => [
					'required' => 'Email belum diisi',
					'valid_emails' => 'Mohon diisi dengan email yang valid',
				]
			],
			'password' => [
				'rules'  => 'required|min_length[8]',
				'errors' => [
					'required' => 'Password belum diisi',
					'min_length' => 'Password memiliki panjang minimal 8 karakter',				
				]
			],
		])) {
			return redirect()->to('login')->withInput();
		}

		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');

		//Cek Login peserta
		$cek_peserta = $this->peserta->cek_peserta($email);

		$user = $cek_peserta['email'];
		$pass_verify = password_verify($password, $cek_peserta['password_peserta']);
		
		if ($user == "") {
			session()->set_flashdata('warning', 'Maaf, NIM Tidak Terdaftar.');
			return redirect()->to('login');
		
		}elseif(!$pass_verify){
			session()->set_flashdata('warning', 'Maaf, Password Yang Anda Masukan Salah.');
			return redirect()->to('login');
		}elseif ($pass_verify) {
			$cek_peserta = $this->peserta->cek_peserta($email);
			
			$user_data = array(
				'id_peserta' 	=> $cek_peserta['id_peserta'],
				'id_peminatan' 		=> $cek_peserta['id_peminatan'],
				'email' 			=> $cek_peserta['email'],
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
		$this->data['title'] 	= "Login Panitia";
		$this->data['page'] 		= "login_panitia";
		$this->data['informasi'] = $this->informasi->findAll();
		
        return view('v_login/v_app', $this->data);
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