<?php
namespace App\Controllers;

use App\Controllers\BaseController;

class Registrasi extends BaseController{
	public function __construct() {
		$this->data = [
			'validation' => \Config\Services::validation(),
		];
	}
	
	public function index()
	{
		return redirect()->to('registrasi/tahap_1');
	}

	public function tahap_1()
	{
		$this->data['title'] 		= "Registrasi Peserta Tahap 1";
		$this->data['judul'] 		= "Pembuatan Akun";
		$this->data['page'] 		= "tahap_1";
		$this->data['informasi'] 	= $this->informasi->findAll();

		return view('v_registrasi/v_app', $this->data);
	}

	public function verifikasi_tahap1()
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
			'confirm_password' => [
				'rules'  => 'required|matches[password]',
				'errors' => [
					'required' => 'Password belum dikonfirmasi',
					'matches' => 'Password tidak cocok',				
				]
			],
		])) {
			return redirect()->to('registrasi/tahap_1')->withInput();
		}
		
		$email = $this->request->getVar('email');
		$password = $this->request->getVar('password');
		//Cek Pendaftaran Peserta
		$cek_pendaftaran = $this->peserta->cek_peserta($email);
		
		if($cek_pendaftaran != NULL){
			$password_peserta = password_verify($password, $cek_pendaftaran['password_peserta']);
			$status_pendaftaran = $cek_pendaftaran['status_pendaftaran'];

			if ($password_peserta != $password) {

				$this->session->set_flashdata('warning', 'Password Yang Anda Masukan Salah.');
				return redirect()->to('registrasi/tahap_1');
			}
			// Tahap 2 Selesai
			elseif ($status_pendaftaran == "Belum Selesai") {
				$this->session->set_flashdata('success', 'Data Diodata '.$email.' Berhasil Disimpan. <br> Silakan Upload Berkas Lamaran!');
				return redirect()->to('registrasi/tahap_3?email='.$email);
			}
			// Tahap 3 Selesai
			elseif ($status_pendaftaran == "Selesai"){
				return redirect()->to('registrasi/selesai/'.$email);
			}
			// Tahap 2 Belum Selesai
			else{
				return redirect()->to('registrasi/tahap_2?email='.$email);
			}
		} else{
			$this->peserta->insert([
				'email' => $email,
				'password_peserta' => password_hash($password, PASSWORD_ARGON2I),
			]);

			return redirect()->to('registrasi/tahap_2?email='.$email);
		}
	}


	public function tahap_2()
	{	
		$email = $this->request->getVar('email');

		$this->data['title'] 	= "Registrasi Peserta Tahap 2";
		$this->data['judul'] 	= "Pengisian Biodata";
		$this->data['page'] 		= "tahap_2";

		$this->data['data_peserta'] 	= $this->peserta->cek_peserta($email);
		$this->data['peminatan'] = $this->peminatan->findAll();
		
		return view('v_registrasi/v_app', $this->data);
	}

	public function verifikasi_tahap2($id_peserta,$email)
	{
		if(!$this->validate([
			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nama belum diisi',
				]
			],
			'jenis_kelamin' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Jenis Kelamin belum diisi',		
				]
			],
			'no_hp' => [
				'rules'  => 'required|min_length[10]|max_length[13]|numeric',
				'errors' => [
					'required' => 'Nomor HP belum diisi',			
					'min_length' => 'Nomor HP terlalu pendek',		
					'max_length' => 'Nomor HP terlalu panjang',
					'numeric' => 'Nomor HP hanya menggunakan angka',
				]
			],
			'peminatan' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Peminatan belum dipilih',		
				]
			],
			'foto' => [
				'rules'  => 'uploaded[foto]|mime_in[foto, image/jpg,image/jpeg]|is_image[foto]|max_size[foto, 500]',
				'errors' => [
					'uploaded' => 'Foto belum di upload',
					'mime_in' => 'Format foto yang diizinkan adalah .jpg dan .jpeg',
					'is_image' => 'File yang diupload bukan gambar.',
					'max_size' => 'Ukuran maksimum foto adalah 500kb.',
				]
			],
		])) {
			return redirect()->to('registrasi/tahap_2?email=' .$email)->withInput();
		}

		$nama_peserta 	= strtoupper($this->request->getVar('nama'));
		$jenis_kelamin	= $this->request->getVar('jenis_kelamin');
		$no_hp 			= $this->request->getVar('no_hp');
		$foto 			= $this->request->getFile('foto');
		$peminatan 			= $this->request->getVar('peminatan');

		$status_pendaftaran = "Belum Selesai";

		$nama_img = $foto->getRandomName();
		$nama_folder = $id_peserta. '_' .url_title($nama_peserta, '_', true);
		$foto->move('assets/academy/img/uploads/berkas_peserta/' .$nama_folder, $nama_img);

		$this->data = [
			'nama_peserta' => $nama_peserta,
			'id_peminatan' => $peminatan,
			'jenis_kelamin' => $jenis_kelamin,
			'no_hp' => $no_hp,
			'status_pendaftaran' => $status_pendaftaran,
			'foto' => $nama_img
		];

		$this->peserta->update($id_peserta, $this->data);
		
		return redirect()->to('registrasi/tahap_3?email='.$email);
	}

	public function tahap_3()
	{	
		$this->data['title'] 	= "Registrasi Peserta Tahap 3";
		$this->data['judul'] 	= "Upload Berkas";
		$this->data['page'] 		= "tahap_3";

		$this->data['data_peserta'] 	= $this->peserta->cek_peserta($this->request->getVar('email'));
		
		return view('v_registrasi/v_app', $this->data);
	}

	public function verifikasi_tahap3($id_peserta,$email)
	{
		if(!$this->validate([
			'foto' => [
				'rules'  => 'uploaded[foto]|mime_in[foto, image/jpg,image/jpeg,image/png]|is_image[foto]|max_size[foto, 2048]',
				'errors' => [
					'uploaded' => 'Foto belum di upload',
					'mime_in' => 'Format foto yang diizinkan adalah .jpg, .jpeg, dan .png',
					'is_image' => 'File yang diupload bukan gambar.',
					'max_size' => 'Ukuran maksimum foto adalah 2mb.',
				]
			],
		])) {
			return redirect()->to('registrasi/tahap_2?email=' .$email)->withInput();
		}

		$nama_peserta = $this->peserta->find($id_peserta)['nama_peserta'];

		$tgl_selesai_pendaftaran = date('Y-m-d');
		$berkas = $this->request->getFile('foto');

		$status_pendaftaran = "Selesai";

		$nama_berkas = $berkas->getRandomName();
		$nama_folder = $id_peserta. '_' .url_title($nama_peserta, '_', true);

		$berkas->move('assets/academy/img/uploads/berkas_peserta/' .$nama_folder, $nama_berkas);

		$this->data = [
			'tgl_selesai_pendaftaran' => $tgl_selesai_pendaftaran,
			'bukti_pembayaran' => $status_pendaftaran,
			'berkas_peserta' => $nama_berkas,
		];
		
		$this->peserta->update($id_peserta, $this->data);

		return redirect()->to('registrasi/selesai?email='.$email);
	}

	public function selesai()
	{	
		$this->data['title'] 	= "Registrasi Selesai";
		$this->data['judul'] 	= "Congratulations!";
		$this->data['page'] 		= "registrasi_selesai";

		$this->data['informasi'] 	= $this->informasi->findAll();
		$this->data['data_peserta'] 	= $this->peserta->cek_peserta($this->request->getVar('email'));

		return view('v_registrasi/v_app', $this->data);
	}
}