<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if(!$this->session->userdata('id_peserta'))
		{
			redirect('access_denied');
		}
	}

	public function index()
	{
		$data ['title'] 	= "Dashboard Peserta";
		$data ['page'] 		= "dashboard_peserta";
		$data ['informasi'] 	= $this->M_informasi->data_informasi()->result();

		$id_peserta = $this->session->userdata('id_peserta');
		$data ['peserta']	= $this->M_peserta->data_peserta($id_peserta)->result();

		// Data Jawaban
		$data ['jawaban'] 	= $this->M_jawaban->cek_jawaban($id_peserta)->num_rows();
		$data ['data_jawaban'] 	= $this->M_jawaban->cek_jawaban($id_peserta)->result();

		//Nilai Peserta
		$data ['data_nilai'] 	= $this->M_nilai->peserta_nilai($id_peserta)->result();

		$this->load->view('v_peserta/v_app', $data);
	}

	public function cetak_kartu()
	{
		$data ['title'] 	= "Dashboard Peserta";
		$data ['page'] 		= "cetak_kartu";
		
		$data ['informasi'] 	= $this->M_informasi->data_informasi()->result();

		$id_peserta = $this->session->userdata('id_peserta');
		$data ['peserta']	= $this->M_peserta->data_peserta($id_peserta)->result();

		$this->load->view('v_peserta/cetak_kartu/index', $data);
	}

	public function acak_soal()
	{
		$id_peserta = $this->session->userdata('id_peserta');
		//Cek Id Peserta Pada Tabel Jawaban
		$cek_peserta = $this->M_jawaban->cek_jawaban($id_peserta)->result();
		foreach ($cek_peserta as $cek_p) {
			$id_p = $cek_p->id_peserta;
		}

		//Jika ID Peserta Tidak Ada
		if ($id_p == "") {
			
			//Jenis Soal
			$soal = $this->M_jenis_soal->data_jenis_soal()->result();
			foreach ($soal as $j_soal) {
				$row = array();
				$row[] = $j_soal->id_soal;

				$data[] = $row; 
			}
			//Id Soal
			$jenis_soal = json_encode($data);
			$jenis_soal = str_replace("[", "", $jenis_soal);
			$jenis_soal = str_replace("]", "", $jenis_soal);
			$jenis_soal = str_replace(",", "", $jenis_soal);
			$jenis_soal = str_replace('"', "", $jenis_soal);
			
			//Hitung Banyak ID Soal
			$panjang = count($data);

			for ($i=0; $i < $panjang; $i++) { 
				$id_soal = $jenis_soal[$i];
				
				//Pertanyaan
				$x = $this->M_pertanyaan->acak_soal($id_soal)->result();
				foreach ($x as $pertanyaan) {
					$rows = array();
					$rows[] = $pertanyaan->id_pertanyaan;

					$data2[] = $rows; 
				}

			}
			//Hitung Jumlah Pertanyyan
			$pertanyan = json_encode($data2);
			$pertanyan = str_replace("[", "", $pertanyan);
			$pertanyan = str_replace("]", "", $pertanyan);
			
			$list_soal = str_replace('"', "", $pertanyan);
			$list_jawaban = str_replace(",", ":X:N:S,", $list_soal);
			
			// Waktu Pengerjaan soal
			$informasi = $this->M_informasi->data_informasi()->result();
			foreach ($informasi as $key) {
				$waktu_pengerjaan = $key->waktu_pengerjaan;
			}

			$waktu_mulai = date('Y-m-d H:i:s');
			$waktu_selesai = date('Y-m-d H:i:s', time() + (60 * $waktu_pengerjaan)); 
			$status_jawaban = "Belum";
			$acak = array(
				'id_peserta' => $id_peserta, 
				'list_soal' => $list_soal, 
				'list_jawaban' => $list_jawaban.":X:N:S", 
				'waktu_mulai' => $waktu_mulai, 
				'waktu_selesai' => $waktu_selesai,
				'status_jawaban' => $status_jawaban
				);

			// Input Jawaban
			$this->M_jawaban->input_jawaban($acak);

			redirect('peserta/ujian_cat/1');
		
		//Jika ID Peserta Ada
		}else{

			redirect('peserta/ujian_cat/1');

		}

	}

	public function ujian_cat($no_soal)
	{
		$id_peserta = $this->session->userdata('id_peserta');
		//Cek Nomor soal
		$cek_nomor 	= $this->M_jawaban->cek_jawaban($id_peserta)->result();
		foreach ($cek_nomor as $cek) {
        	$list_soal = $cek->list_soal;
        	$list_jawaban = $cek->list_jawaban;
        }
        $jwb = explode(",", $list_soal);
        $no = sizeof($jwb);
        
        //Jika Melewati No Soal
        if ($no_soal<=0 OR $no_soal>$no) {
        	redirect('peserta/ujian_cat/1');
        }

		$data ['title'] 	= "Computer Assisted Test";
		$data ['page'] 		= "ujian_cat";
		$data ['informasi'] 	= $this->M_informasi->data_informasi()->result();

		$id_peserta = $this->session->userdata('id_peserta');
		$data ['peserta']	= $this->M_peserta->data_peserta($id_peserta)->result();

		// Data Jawaban
		$data ['data_jawaban'] 	= $this->M_jawaban->cek_jawaban($id_peserta)->result();
		$waktu = $this->M_jawaban->cek_jawaban($id_peserta)->result();
		foreach ($waktu as $wt) {
			$waktu_selesai = $wt->waktu_selesai;
		}
		$data ['waktu_selesai'] = $waktu_selesai; 


		//Menampilkan Pertanyaan
        $soal_ke = $no_soal-1;
        $soal = explode(",", $list_jawaban);
        $soal_list = $soal[$soal_ke];
        $soal_list = explode(":", $soal_list);
        $id_pertanyaan = $soal_list[0];

        $data ['jawaban_peserta'] = $soal_list[1];
       	$data ['tampil_soal'] = $this->M_jawaban->list_jawaban($id_pertanyaan)->result();
        $data ['no_soal'] = $no_soal;

		$this->load->view('v_peserta/v_app', $data);
		
	}

	public function simpan_jawaban($no_soal)
	{
		$id_peserta  	= $this->session->userdata('id_peserta');
		$j_peserta		= $this->input->post('jawaban_peserta');
		$id_soal		= $this->input->post('id_soal');

		$next = $no_soal+1;
		$list = $no_soal-1;

		//Cek Data Peserta Dan Soal Pada Tabel Nilai
		$cek_nilai = $this->M_nilai->cek_nilai($id_peserta, $id_soal)->result();
		foreach ($cek_nilai as $cek_n) {
			$id_pe = $cek_n->id_peserta;
			$id_so = $cek_n->id_soal;
			$tot_n = $cek_n->nilai_peserta;
		}
	
		//Id Peserta dan Id Soal Tidak Ada Dalam Tabel Nilai
		if ($id_pe == "" && $id_so == "") {
			
			//Jawaban Kosong
			if ($j_peserta == "") {
				redirect('peserta/ujian_cat/'.$next);
		
			}else{
				
				//Cek No Soal Jawaban Peserta
				$cek_jawaban = $this->M_jawaban->cek_jawaban($id_peserta)->result();
				foreach ($cek_jawaban as $cek) {
		        	$list_jawaban = $cek->list_jawaban;
		        }

		        //List Jawaban
		        $jwb = explode(",", $list_jawaban);
		        $jawaban = $jwb[$list]; 
		        $hsl = explode(":", $jawaban);
		        /*
		        $hsl[0]  -------- id_pertanyaan;
		        $hsl[1]  -------- Jawaban Peserta;
		        $hsl[2]  -------- Keterangan;
		        $hsl[3]  -------- Benar/Salah;
		        */

		        //Pengecekan Kunci jawaban
		        $id_pertanyaan = $hsl[0];
		        $cek_pertanyaan = $this->M_pertanyaan->tampil_edit($id_pertanyaan)->result();
		        foreach ($cek_pertanyaan as $cek_per) {
		        	$kunci_jawaban = $cek_per->jawaban;
		        }
		        if ($kunci_jawaban == $j_peserta) {
		        	//Benar
		        	$hsl[1] = $j_peserta;
		        	$hsl[2] = "Y";
		        	$hsl[3] = "B";

		        	//Masukan Nilai Peserta
					$nilai = [
						'id_peserta' => $id_peserta,
						'id_soal' => $id_soal,
						'nilai_peserta' => "5"
					];
					$this->M_nilai->input_nilai($nilai);

					$hsl = implode(':', $hsl);

			        //Masukan Jawaban Peserta
			        $jwb[$list] = $hsl;
			        $jawaban_peserta = implode(',', $jwb);

			        //Update Jawaban 
			        $data = [
			        	'list_jawaban' => $jawaban_peserta
			        ];
			        
			        $this->M_jawaban->update_jawaban($data, $id_peserta);

		        }else{
		        	//Salah
		        	$hsl[1] = $j_peserta;
		        	$hsl[2] = "Y";

		        	//Masukan Nilai Peserta
					$nilai = [
						'id_peserta' => $id_peserta,
						'id_soal' => $id_soal,
						'nilai_peserta' => "0"
					];
					$this->M_nilai->input_nilai($nilai);

					$hsl = implode(':', $hsl);
					
					//Masukan Jawaban Peserta
			        $jwb[$list] = $hsl;
			        $jawaban_peserta = implode(',', $jwb);

			        //Update Jawaban 
			        $data = [
			        	'list_jawaban' => $jawaban_peserta
			        ];
			        
			        $this->M_jawaban->update_jawaban($data, $id_peserta);
		        }

				redirect('peserta/ujian_cat/'.$next);
				
			}
		
		//Id Peserta dan Id Soal Ada Dalam Tabel Nilai
		}else{

			//Cek Jawaban Peserta
			if ($j_peserta == "") {
				redirect('peserta/ujian_cat/'.$next);

			}else{

				//List Jawaban Peserta
				$cek_jawaban = $this->M_jawaban->cek_jawaban($id_peserta)->result();
				foreach ($cek_jawaban as $cek) {
		        	$list_jawaban = $cek->list_jawaban;
		        }

		        //List Jawaban
		        $jwb = explode(",", $list_jawaban);
		        $jawaban = $jwb[$list]; 
		        $hsl = explode(":", $jawaban);
		        
		        //Pengecekan Kunci jawaban
		        $id_pertanyaan = $hsl[0];
		        $bs = $hsl[3];
		        $cek_pertanyaan = $this->M_pertanyaan->tampil_edit($id_pertanyaan)->result();
		        foreach ($cek_pertanyaan as $cek_per) {
		        	$kunci_jawaban = $cek_per->jawaban;
		        }

		        if ($bs == "B") {
		        	//Benar
		        	if ($kunci_jawaban == $j_peserta) {
		        		redirect('peserta/ujian_cat/'.$next);
		        	}
		        	//Salah
		        	else{
		        	$hsl[1] = $j_peserta;
		        	$hsl[3] = "S";

		        	$hsl = implode(':', $hsl);
					
					//Masukan Jawaban Peserta
			        $jwb[$list] = $hsl;
			        $jawaban_peserta = implode(',', $jwb);

			        //Update Jawaban 
			        $data = [
			        	'list_jawaban' => $jawaban_peserta
			        ];
			        $this->M_jawaban->update_jawaban($data, $id_peserta);

			        //Upadate Nilai Peserta
			        $nilai_peserta = $tot_n - 5;
			        if ($nilai_peserta <= 0) {
			        	$nilai_peserta = 0;
			        }
					$nilai = [
						'nilai_peserta' => $nilai_peserta
					];
					$this->M_nilai->update_nilai($id_peserta, $id_soal, $nilai);

		        	}

		        }else{
		        	//Benar
		        	if ($kunci_jawaban == $j_peserta) {
		        		$hsl[1] = $j_peserta;
		        		$hsl[2] = "Y";
		        		$hsl[3] = "B";
		        		$hsl = implode(':', $hsl);

		        		//Masukan Jawaban Peserta
			        	$jwb[$list] = $hsl;
			        	$jawaban_peserta = implode(',', $jwb);

			        	//Update Jawaban 
				        $data = [
				        	'list_jawaban' => $jawaban_peserta
				        ];
				        $this->M_jawaban->update_jawaban($data, $id_peserta);

				        //Upadate Nilai Peserta
			        	$nilai_peserta = $tot_n + 5;
			        	$nilai = [
							'nilai_peserta' => $nilai_peserta
						];
						$this->M_nilai->update_nilai($id_peserta, $id_soal, $nilai);

		        	}
		        	else{
		        		//Salah

		        		$hsl[1] = $j_peserta;
		        		$hsl[2] = "Y";
		        		$hsl[3] = "S";
		        		$hsl = implode(':', $hsl);

		        		//Masukan Jawaban Peserta
			        	$jwb[$list] = $hsl;
			        	$jawaban_peserta = implode(',', $jwb);

			        	//Update Jawaban 
				        $data = [
				        	'list_jawaban' => $jawaban_peserta
				        ];
				        $this->M_jawaban->update_jawaban($data, $id_peserta);

		        	}
		        	
		        }

				redirect('peserta/ujian_cat/'.$next);
			}
			

		}
		 
	}

	public function selesai_ujian()
	{
		$id_peserta  	= $this->session->userdata('id_peserta');
		//Update Jawaban 
        $data = [
        	'status_jawaban' => "Selesai"
        ];
        
        $this->M_jawaban->update_jawaban($data, $id_peserta);

        redirect('peserta');
		
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}