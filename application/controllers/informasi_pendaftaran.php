<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_pendaftaran extends CI_Controller {

	function __construct() {
		parent::__construct();
		if($this->session->userdata('level_admin') != "1")
		{
			redirect('access_denied');
		}
	}

	public function index()
	{
		$data ['title'] 	= "Informasi Pendaftaran";
		$data ['page'] 		= "informasi_pendaftaran";
		
		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();

		$data ['formasi_lab']	= $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] 	= $this->M_jenis_soal->data_jenis_soal()->result();
		$data ['informasi'] 	= $this->M_informasi->data_informasi()->result();
		$this->load->view('v_admin/v_app', $data);
	}

	public function edit($id_informasi)
	{
		$nama_kegiatan		= $this->input->post('nama_kegiatan');
		$tgl_pendaftaran 	= explode(" - ", $this->input->post('tgl_pendaftaran'));
		$tgl_lulus_adm		= ubah_tgl($this->input->post('tgl_lulus_adm'));
		$tgl_ujian_cat		= ubah_tgl($this->input->post('tgl_ujian_cat'));
		$waktu_pengerjaan	= $this->input->post('waktu_pengerjaan');
		
		$lokasi_file		= $_FILES['alur_pendaftaran']['tmp_name'];
		
		$tgl1 = ubah_tgl($tgl_pendaftaran[0]);
		$tgl2 = ubah_tgl($tgl_pendaftaran[1]);
		
		if ($lokasi_file == "") {
			
			$data = [
				'nama_kegiatan' => $nama_kegiatan,
				'tgl_pendaftaran' => $tgl1,
				'tgl_tutup' => $tgl2,
				'tgl_lulus_adm' => $tgl_lulus_adm,
				'tgl_ujian_cat' => $tgl_ujian_cat,
		 		'waktu_pengerjaan' => $waktu_pengerjaan
			];

			$simpan = $this->M_informasi->update_informasi($data, $id_informasi);

			if (!$simpan) {
				$this->session->set_flashdata('success', 'Data Berhasil Disimpan.');
			} else{
				$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
			}
			redirect('informasi_pendaftaran');
		
		}else{
			$config['upload_path']          = './uploads/pengumuman/';
			$config['allowed_types']        = 'jpg';
			$config['max_size']             = 2048;
			
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('alur_pendaftaran')){
	                    
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('warning', $error);
                redirect('informasi_pendaftaran');
                
	        }else{

	        	$alur_pendaftaran = $this->upload->data('file_name');
	        	$data = [
					'nama_kegiatan' => $nama_kegiatan,
					'tgl_pendaftaran' => $tgl1,
					'tgl_tutup' => $tgl2,
					'tgl_lulus_adm' => $tgl_lulus_adm,
					'tgl_ujian_cat' => $tgl_ujian_cat,
					'tgl_lulus_cat' => $tgl_lulus_cat,
			 		'waktu_pengerjaan' => $waktu_pengerjaan,
			 		'alur_pendaftaran' => $alur_pendaftaran
				];

				$simpan = $this->M_informasi->update_informasi($data, $id_informasi);

				if (!$simpan) {
					$this->session->set_flashdata('success', 'Data Berhasil Disimpan.');
				} else{
					$this->session->set_flashdata('warning', 'Data Gagal Disimpan');
				}
				redirect('informasi_pendaftaran');
		    }
		}
	}
}
