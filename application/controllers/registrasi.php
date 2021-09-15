<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	public function index()
	{
		redirect('registrasi/tahap_1');
		
	}

	public function tahap_1()
	{
		$data ['title'] 	= "Registrasi Peserta Tahap 1";
		$data ['judul'] 	= "Pembuatan Akun";
		$data ['page'] 		= "tahap_1";
		$data ['informasi'] 	= $this->M_informasi->data_informasi()->result();
		$this->load->view('v_registrasi/v_app', $data);
	}

	public function verifikasi_tahap1()
	{
		$nim	 				= $this->input->post('nim');
		$password	 			= $this->input->post('password');
		$comfirm_password	 	= $this->input->post('comfirm_password');

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('comfirm_password', 'Comfirm Password', 'trim|required|min_length[8]|matches[password]');

		if($this->form_validation->run() == FALSE) {

			$data = array(
				'warning' => validation_errors() 
				);

			$this->session->set_flashdata($data);
	
			redirect('registrasi/tahap_1');

		}else{
			$angkatan =  substr($nim,0,4);
			$jurusan = substr($nim,4,2);
			
			if ($angkatan != "2017") {
				$this->session->set_flashdata('warning', 'Anda mahasiswa angkatan '.$angkatan.'.<br> Pendaftaran Dapat Dilakukan Oleh Mahasiswa angkatan 2017 !');
				redirect('registrasi/tahap_1');

			}elseif ($jurusan != "46"){
				$this->session->set_flashdata('warning', 'Anda bukan Mahasiswa Jurusan Teknik Informatika !');
				redirect('registrasi/tahap_1');
			}else{

				//Cek Pendaftaran Peserta
				$cek_pendaftaran = $this->M_peserta->cek_paserta($nim)->result();
				foreach ($cek_pendaftaran as $key) {
					$id_peserta = $key->id_peserta;
					$password_peserta = $this->encryption->decrypt($key->password_peserta);
					$status_pendaftaran = $key->status_pendaftaran;
				}
				// Peserta Belum Ada Akun
				if ($id_peserta == "") {
					$data = [
						'nim' =>$nim,
						'password_peserta' =>$this->encryption->encrypt($password)
					];

					$simpan = $this->M_peserta->input_peserta($data);		
					if(!$simpan) {
						$this->session->set_flashdata('success', 'Akun Berhasil Dibuat.');
						redirect('registrasi/tahap_2/'.$nim);
					} else {
						$this->session->set_flashdata('warning', 'Akun Gagal Dibuat.');
						redirect('registrasi/tahap_1');
					}

				}else{

					//Cek Password
					if ($password_peserta != $password) {
						$this->session->set_flashdata('warning', 'Password Yang Anda Masukan Salah.');
						redirect('registrasi/tahap_1');
					}

					// Tahap 2 Selesai
					elseif ($status_pendaftaran == "Belum Selesai") {
						$this->session->set_flashdata('success', 'Data Diodata '.$nim.' Berhasil Disimpan. <br> Silakan Upload Berkas Lamaran!');
						redirect('registrasi/tahap_3/'.$nim);
					}

					// Tahap 3 Selesai
					elseif ($status_pendaftaran == "Selesai"){
						redirect('registrasi/selesai/'.$nim);
					}

					// Tahap 2 Belum Selesai
					else{
						redirect('registrasi/tahap_2/'.$nim);

					}
					
				}
				
			}
		}
		
	}


	public function tahap_2($nim)
	{	
		$data ['title'] 	= "Registrasi Peserta Tahap 2";
		$data ['judul'] 	= "Pengisian Biodata";
		$data ['page'] 		= "tahap_2";

		$data ['data_peserta'] 	= $this->M_peserta->cek_paserta($nim)->result();

		$this->load->view('v_registrasi/v_app', $data);
	}

	public function verifikasi_tahap2($id_peserta,$nim)
	{
		$nama_peserta 	= strtoupper($this->input->post('nama_peserta'));
		$ipk 			= $this->input->post('ipk');
		$tmp_lahir 		= strtoupper($this->input->post('tmp_lahir'));
		$tgl_lahir		= ubah_tgl($this->input->post('tgl_lahir'));
		$jenis_kelamin	= $this->input->post('jenis_kelamin');
		$no_hp 			= $this->input->post('no_hp');
		$email 			= $this->input->post('email');
		$agama 			= $this->input->post('agama');

		$status_pendaftaran = "Belum Selesai";

		$config['upload_path']          = './uploads/berkas_peserta/';
		$config['allowed_types']        = 'jpg';
		$config['max_size']             = 256;
		$config['max_width']            = 354;
        $config['max_height']           = 472;

        $this->upload->initialize($config);

        if ( ! $this->upload->do_upload('foto')){
	                    
	        $error = $this->upload->display_errors();
	        $this->session->set_flashdata('warning', $error);
	        redirect('registrasi/tahap_2/'.$nim);
	        
	    }else{

	    	$foto = $this->upload->data('file_name');
	    	$data = [
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

			$simpan = $this->M_peserta->update_paserta($data, $id_peserta);
			if (!$simpan) {
				$this->session->set_flashdata('success', 'Data Diodata '.$nim.' Berhasil Disimpan. <br> Silakan Upload Berkas Lamaran!');
			} else{
				$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
			}
			redirect('registrasi/tahap_3/'.$nim);
	    }

	}

	public function tahap_3($nim)
	{	
		$data ['title'] 	= "Registrasi Peserta Tahap 3";
		$data ['judul'] 	= "Upload Berkas";
		$data ['page'] 		= "tahap_3";

		$data ['data_peserta'] 	= $this->M_peserta->cek_paserta($nim)->result();
		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();

		$this->load->view('v_registrasi/v_app', $data);
	}

	public function verifikasi_tahap3($id_peserta,$nim)
	{
		$id_lab = $this->input->post('id_lab');
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
	        redirect('registrasi/tahap_3/'.$nim);
	        
	    }else{ 

	    	$berkas_peserta = $this->upload->data('file_name');

	    	$data = [
				'id_lab' => $id_lab,
				'tgl_selesai_pendaftaran' => $tgl_selesai_pendaftaran,
				'status_pendaftaran' => $status_pendaftaran,
				'berkas_peserta' => $berkas_peserta
			];

			$data_lab = [
				'jumlah_peserta' => $jumlah_peserta+1
			];

			$this->M_formasi_lab->update_formasi_lab($data_lab, $id_lab);
			$this->M_peserta->update_paserta($data, $id_peserta);
			redirect('registrasi/selesai/'.$nim);
	    }
	}

	public function selesai($nim)
	{	
		$data ['title'] 	= "Registrasi Selesai";
		$data ['judul'] 	= "Congratulations !";
		$data ['page'] 		= "registrasi_selesai";

		$data ['informasi'] 	= $this->M_informasi->data_informasi()->result();
		$data ['data_peserta'] 	= $this->M_peserta->cek_paserta($nim)->result();

		$this->load->view('v_registrasi/v_app', $data);
	}
}