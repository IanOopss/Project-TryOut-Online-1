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
		$this->data ['title'] 	= "Registrasi Peserta Tahap 1";
		$this->data ['judul'] 	= "Pembuatan Akun";
		$this->data ['page'] 		= "tahap_1";
		$this->data ['informasi'] 	= $this->informasi->data_informasi();

		return view('v_registrasi/v_app', $this->data);
	}

	public function verifikasi_tahap1()
	{
		$nim = $this->request->getVar('nim');

		if(!$this->validate([
			'nim' => [
				'rules'  => 'required|numeric',
				'errors' => [
					'required' => 'NIM belum diisi',
					'numeric' => 'NIM hanya terdiri dari angka',
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
		
		$angkatan =  substr($nim,0,4);
		$jurusan = substr($nim,4,2);
		
		if ($angkatan != "2017") {
			$msg = 'Anda mahasiswa angkatan '.$angkatan.'.<br> Pendaftaran Dapat Dilakukan Oleh Mahasiswa angkatan 2017 !';
			return redirect()->to('registrasi/tahap_1')->with('msg', $msg)->withInput();
		}
		
		if ($jurusan != "46"){
			$msg = 'Anda bukan Mahasiswa Jurusan Teknik Informatika!';
			return redirect()->to('registrasi/tahap_1')->with('msg', $msg)->withInput();
		}

		$password = $this->request->getVar('password');
		
		//Cek Pendaftaran Peserta
		$cek_pendaftaran = $this->peserta->cek_peserta($nim);
		if($cek_pendaftaran != NULL){
			$password_peserta = $this->encryption->decrypt($cek_pendaftaran['password_peserta']);
			$status_pendaftaran = $cek_pendaftaran['status_pendaftaran'];

			if ($password_peserta != $password) {
				$this->session->set_flashdata('warning', 'Password Yang Anda Masukan Salah.');
				return redirect()->to('registrasi/tahap_1');
			}
			// Tahap 2 Selesai
			elseif ($status_pendaftaran == "Belum Selesai") {
				$this->session->set_flashdata('success', 'Data Diodata '.$nim.' Berhasil Disimpan. <br> Silakan Upload Berkas Lamaran!');
				return redirect()->to('registrasi/tahap_3/'.$nim);
			}
			// Tahap 3 Selesai
			elseif ($status_pendaftaran == "Selesai"){
				return redirect()->to('registrasi/selesai/'.$nim);
			}
			// Tahap 2 Belum Selesai
			else{
				return redirect()->to('registrasi/tahap_2/'.$nim);
			}
		} else{
			$this->peserta->insert([
				'nim' => $nim,
				'password_peserta' => $this->encryption->encrypt($password),
			]);

			//pesan yang ditampilkan apabila input success
			// session()->setFlashdata('pesan', 'Registrasi Tahap 1 telah sukses');

			return redirect()->to('registrasi/tahap_2?nim='.$nim);
		}
	}


	public function tahap_2()
	{	
		$nim = $this->request->getVar('nim');

		$this->data ['title'] 	= "Registrasi Peserta Tahap 2";
		$this->data ['judul'] 	= "Pengisian Biodata";
		$this->data ['page'] 		= "tahap_2";

		$this->data ['data_peserta'] 	= $this->peserta->cek_peserta($nim);

		return view('v_registrasi/v_app', $this->data);
	}

	public function verifikasi_tahap2($id_peserta,$nim)
	{
		$nama_peserta 	= strtoupper($this->request->getVar('nama_peserta'));
		$ipk 			= $this->request->getVar('ipk');
		$tmp_lahir 		= strtoupper($this->request->getVar('tmp_lahir'));
		$tgl_lahir		= ubah_tgl($this->request->getVar('tgl_lahir'));
		$jenis_kelamin	= $this->request->getVar('jenis_kelamin');
		$no_hp 			= $this->request->getVar('no_hp');
		$email 			= $this->request->getVar('email');
		$agama 			= $this->request->getVar('agama');

		$status_pendaftaran = "Belum Selesai";

		$config['upload_path']          = './uploads/berkas_peserta/';
		$config['allowed_types']        = 'jpg';
		$config['max_size']             = 256;
		$config['max_width']            = 354;
        $config['max_height']           = 472;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('foto')){
	                    
	        $error = $this->upload->display_errors();
	        $this->session->set_flashdata('warning', $error);
	        return redirect()->to('registrasi/tahap_2/'.$nim);
	        
	    }else{

	    	$foto = $this->upload->data('file_name');
	    	$this->data = [
				'nama_peserta' => $nama_peserta,
				'ipk' => $ipk,
				'tmp_lahir' => $tmp_lahir ,
				'tgl_lahir' => $tgl_lahir,
				'jenis_kelamin' => $jenis_kelamin,
				'no_hp' => $no_hp,
		 		'email' => $email,
		 		'agama' => $agama,
		 		'status_pendaftaran' => $status_pendaftaran,
		 		'foto' => $foto
			];

			$simpan = $this->peserta->update_paserta($this->data, $id_peserta);
			if (!$simpan) {
				$this->session->set_flashdata('success', 'Data Diodata '.$nim.' Berhasil Disimpan. <br> Silakan Upload Berkas Lamaran!');
			} else{
				$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
			}
			return redirect()->to('registrasi/tahap_3/'.$nim);
	    }

	}

	public function tahap_3($nim)
	{	
		$this->data ['title'] 	= "Registrasi Peserta Tahap 3";
		$this->data ['judul'] 	= "Upload Berkas";
		$this->data ['page'] 		= "tahap_3";

		$this->data ['data_peserta'] 	= $this->peserta->cek_peserta($nim)->result();
		$this->data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();

		return view('v_registrasi/v_app', $this->data);
	}

	public function verifikasi_tahap3($id_peserta,$nim)
	{
		$id_lab = $this->request->getVar('id_lab');
		$tgl_selesai_pendaftaran = date('Y-m-d');
		$status_pendaftaran = "Selesai";

		//Cek Jumlah Peserta Formasi Pada Lab
		$cek_formasi = $this->M_formasi_lab->cek_formasi_lab($id_lab)->result();
		foreach ($cek_formasi as $key) {
			$jumlah_peserta = $key->jumlah_peserta;
		}

		$config['upload_path']          = './uploads/berkas_peserta/';
		$config['allowed_types']        = 'pdf';
		$config['max_size']             = 2048;

		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('berkas_peserta')){
	                    
	        $error = $this->upload->display_errors();
	        $this->session->set_flashdata('warning', $error);
	        return redirect()->to('registrasi/tahap_3/'.$nim);
	        
	    }else{ 

	    	$berkas_peserta = $this->upload->data('file_name');

	    	$this->data = [
				'id_lab' => $id_lab,
				'tgl_selesai_pendaftaran' => $tgl_selesai_pendaftaran,
				'status_pendaftaran' => $status_pendaftaran,
				'berkas_peserta' => $berkas_peserta
			];

			$this->data_lab = [
				'jumlah_peserta' => $jumlah_peserta+1
			];

			$this->M_formasi_lab->update_formasi_lab($this->data_lab, $id_lab);
			$this->peserta->update_paserta($this->data, $id_peserta);
			return redirect()->to('registrasi/selesai/'.$nim);
	    }
	}

	public function selesai($nim)
	{	
		$this->data ['title'] 	= "Registrasi Selesai";
		$this->data ['judul'] 	= "Congratulations !";
		$this->data ['page'] 		= "registrasi_selesai";

		$this->data ['informasi'] 	= $this->informasi->data_informasi()->result();
		$this->data ['data_peserta'] 	= $this->peserta->cek_peserta($nim)->result();

		return view('v_registrasi/v_app', $this->data);
	}
}