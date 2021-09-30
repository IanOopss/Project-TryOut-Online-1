<?php
namespace App\Controllers;

class Peserta extends BaseController
{
	public function __construct(){
		$this->id_peserta = session()->get('id_peserta');
	}

	public function index()
	{
		$this->data['title'] 	= "Dashboard Peserta";
		$this->data['page'] 		= "dashboard_peserta";
		$this->data['informasi'] 	= $this->informasi->findAll();

		$this->data['peserta'] = $this->peserta->find($this->id_peserta);
		
		// Data Jawaban
		$this->data['jawaban'] 	= $this->jawaban->where('id_peserta', $this->id_peserta)->countAllResults();
		$this->data['data_jawaban'] 	= $this->jawaban->where('id_peserta', $this->id_peserta)->first();
		
		//Nilai Peserta
		$this->data['data_nilai'] 	= $this->nilai->getNilai($this->id_peserta);
		
		$this->data['data_lab'] 	= $this->peminatan->find($this->data['peserta']['id_peminatan']);
		$this->data['nama_folder']	= $this->data['peserta']['id_peserta']. '_' .url_title($this->data['peserta']['nama_peserta'], '_', true);

		// Waktu Pengerjaan soal
		$this->data['waktu_pengerjaan'] = $this->peminatan->find(session()->get('id_peminatan'))['waktu_pengerjaan'];

		return view('v_peserta/v_app', $this->data);
	}
	
	public function cetak_kartu()
	{
		$this->data['title'] 		= "Dashboard Peserta";
		$this->data['page'] 		= "cetak_kartu";
		
		$this->data['informasi'] 	= $this->informasi->findAll();
		$this->data['peserta'] 		= $this->peserta->find($this->id_peserta);
		$this->data['data_lab'] 	= $this->peminatan->find($this->data['peserta']['id_peminatan']);

		return view('v_peserta/cetak_kartu/index', $this->data);
	}

	public function acak_soal()
	{
		//Cek Id Peserta Pada Tabel Jawaban
		$cek_peserta = $this->jawaban->where('id_peserta', $this->id_peserta)->first();
		
		//Jika ID Peserta Tidak Ada
		if($cek_peserta == NULL) {
			//Jenis Soal
			$soal = $this->soal->where('id_peminatan', session()->get('id_peminatan'))->findAll();

			foreach ($soal as $j_soal) {
				$row[] = $j_soal['id_soal'];
			}

			//Id Soal
			$jenis_soal = json_encode($row);
			$jenis_soal = str_replace("[", "", $jenis_soal);
			$jenis_soal = str_replace("]", "", $jenis_soal);
			$jenis_soal = str_replace(",", "", $jenis_soal);
			$jenis_soal = str_replace('"', "", $jenis_soal);
			
			//Hitung Banyak ID Soal
			$panjang = count($row);
			for ($i=0; $i < $panjang; $i++) { 
				$id_soal = $jenis_soal[$i];
				//Pertanyaan
				$x = $this->pertanyaan->acak_soal($id_soal);
				foreach ($x as $pertanyaan) {
					$rows[] = $pertanyaan['id_pertanyaan'];
				}
			}

			//Hitung Jumlah Pertanyyan
			$pertanyan = json_encode($rows);
			$pertanyan = str_replace("[", "", $pertanyan);
			$pertanyan = str_replace("]", "", $pertanyan);
			
			$list_soal = str_replace('"', "", $pertanyan);
			$list_jawaban = str_replace(",", ":X:N:S,", $list_soal);
			
			// Waktu Pengerjaan soal
			$waktu_pengerjaan = $this->peminatan->find(session()->get('id_peminatan'))['waktu_pengerjaan'];

			$waktu_mulai = date('Y-m-d H:i:s');
			$waktu_selesai = date('Y-m-d H:i:s', time() + (60 * $waktu_pengerjaan)); 
			$status_jawaban = "Belum";
			$acak = array(
				'id_peserta' => $this->id_peserta, 
				'list_soal' => $list_soal, 
				'list_jawaban' => $list_jawaban.":X:N:S", 
				'waktu_mulai' => $waktu_mulai, 
				'waktu_selesai' => $waktu_selesai,
				'status_jawaban' => $status_jawaban
			);
			
			// Input Jawaban
			$this->jawaban->insert($acak);

			return redirect()->to('peserta/ujian_cat/1');
		}else{
			return redirect()->to('peserta/ujian_cat/1');
		}
	}

	public function ujian_cat($no_soal)
	{
		//Cek Nomor soal
		$cek_nomor 	= $this->jawaban->where('id_peserta', $this->id_peserta)->first();

		if($cek_nomor['status_jawaban'] == 'Selesai'){
			return redirect()->to('peserta');
		}

		$list_soal = $cek_nomor['list_soal'];
		$list_jawaban = $cek_nomor['list_jawaban'];
        
		$jwb = explode(",", $list_soal);
        $no = sizeof($jwb);
        //Jika Melewati No Soal
        if ($no_soal <= 0 || $no_soal > $no) {
        	return redirect()->to('peserta/ujian_cat/1');
        }

		$this->data['title'] 	= "Computer Assisted Test";
		$this->data['page'] 		= "ujian_cat";
		$this->data['informasi'] 	= $this->informasi->findAll();

		$this->data['peserta']	= $this->peserta->where('id_peserta', $this->id_peserta)->first();

		// Data Jawaban
		$this->data['data_jawaban'] = $this->jawaban->where('id_peserta', $this->id_peserta)->first();

		$this->data['waktu_selesai'] = $this->data['data_jawaban']['waktu_selesai']; 

		//Menampilkan Pertanyaan
        $soal_ke = $no_soal - 1;
        $soal = explode(",", $list_jawaban);
        $soal_list = $soal[$soal_ke];
        $soal_list = explode(":", $soal_list);
        $id_pertanyaan = $soal_list[0];

        $this->data['jawaban_peserta'] = $soal_list[1];
       	$this->data['tampil_soal'] = $this->pertanyaan->list_jawaban($id_pertanyaan);
        $this->data['no_soal'] = $no_soal;
		$this->data['data_lab'] 	= $this->peminatan->find($this->data['peserta']['id_peminatan']);
		$this->data['waktu'] = $this->peminatan->find(session()->get('id_peminatan'))['waktu_pengerjaan'];
		
		return view('v_peserta/v_app', $this->data);
	}

	public function simpan_jawaban($no_soal)
	{
		$j_peserta		= $this->request->getVar('jawaban_peserta');
		$id_soal		= $this->request->getVar('id_soal');

		$next = $no_soal + 1;
		$list = $no_soal - 1;
		
		//Cek Data Peserta Dan Soal Pada Tabel Nilai
		$cek_nilai = $this->nilai->cek_nilai($this->id_peserta, $id_soal);

		if($cek_nilai != null){
			foreach ($cek_nilai as $cek_n) {
				$tot_n = $cek_n['nilai_peserta'];
			}
		}
		//Id Peserta dan Id Soal Tidak Ada Dalam Tabel Nilai
		if ($cek_nilai == null) {
			//Jawaban Kosong
			if ($j_peserta == "") {
				return redirect()->to('peserta/ujian_cat/'.$next);
			}else{
				
				//Cek No Soal Jawaban Peserta
				$cek_jawaban = $this->jawaban->where('id_peserta', $this->id_peserta)->first();
				
				$list_jawaban = $cek_jawaban['list_jawaban'];
		        
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
		        $cek_pertanyaan = $this->pertanyaan->find($id_pertanyaan);

				$kunci_jawaban = $cek_pertanyaan['jawaban'];
				
		        if ($kunci_jawaban == $j_peserta) {
		        	//Benar
		        	$hsl[1] = $j_peserta;
		        	$hsl[2] = "Y";
		        	$hsl[3] = "B";

		        	//Masukan Nilai Peserta
					$nilai = [
						'id_peserta' => $this->id_peserta,
						'id_soal' => $id_soal,
						'nilai_peserta' => "5"
					];

					$this->nilai->insert($nilai);

					$hsl = implode(':', $hsl);

			        //Masukan Jawaban Peserta
			        $jwb[$list] = $hsl;
			        $jawaban_peserta = implode(',', $jwb);

			        //Update Jawaban 
			        $data = [
			        	'list_jawaban' => $jawaban_peserta
			        ];
			        
			        $this->jawaban->update($this->id_peserta, $data);

		        }else{
		        	//Salah
		        	$hsl[1] = $j_peserta;
		        	$hsl[2] = "Y";

		        	//Masukan Nilai Peserta
					$nilai = [
						'id_peserta' => $this->id_peserta,
						'id_soal' => $id_soal,
						'nilai_peserta' => "0"
					];
					
					$this->nilai->insert($nilai);

					$hsl = implode(':', $hsl);
					
					//Masukan Jawaban Peserta
			        $jwb[$list] = $hsl;
			        $jawaban_peserta = implode(',', $jwb);

			        //Update Jawaban 
			        $data = [
			        	'list_jawaban' => $jawaban_peserta
			        ];
					
					$this->jawaban->update_jawaban($this->id_peserta, $data);
		        }
				return redirect()->to('peserta/ujian_cat/'.$next);
			}
		
		//Id Peserta dan Id Soal Ada Dalam Tabel Nilai
		}else{

			//Cek Jawaban Peserta
			if ($j_peserta == "") {
				return redirect()->to('peserta/ujian_cat/'.$next);
			}else{
				//List Jawaban Peserta
				$cek_jawaban = $this->jawaban->where('id_peserta', $this->id_peserta)->findAll();
				
				foreach($cek_jawaban as $cek){
					$list_jawaban = $cek['list_jawaban'];
				}

		        //List Jawaban
		        $jwb = explode(",", $list_jawaban);
		        $jawaban = $jwb[$list]; 
		        $hsl = explode(":", $jawaban);
		        
		        //Pengecekan Kunci jawaban
		        $id_pertanyaan = $hsl[0];
		        $bs = $hsl[3];
		        $cek_pertanyaan = $this->pertanyaan->find($id_pertanyaan);
				
				$kunci_jawaban = $cek_pertanyaan['jawaban'];
				
		        if ($bs == "B") {
		        	//Benar
		        	if ($kunci_jawaban == $j_peserta) {
		        		return redirect()->to('peserta/ujian_cat/'.$next);
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
					
					$this->jawaban->update_jawaban($this->id_peserta, $data);

			        //Upadate Nilai Peserta
			        $nilai_peserta = $tot_n - 5;

			        if ($nilai_peserta <= 0) {
			        	$nilai_peserta = 0;
			        }

					$nilai = [
						'nilai_peserta' => $nilai_peserta
					];
					$this->nilai->update_nilai($this->id_peserta, $id_soal, $nilai);
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
					
						$this->jawaban->update_jawaban($this->id_peserta, $data);

				        //Upadate Nilai Peserta
			        	$nilai_peserta = $tot_n + 5;
			        	$nilai = [
							'nilai_peserta' => $nilai_peserta
						];

						$this->nilai->update_nilai($this->id_peserta, $id_soal, $nilai);
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
					
						$this->jawaban->update_jawaban($this->id_peserta, $data);
		        	}
		        }
				return redirect()->to('peserta/ujian_cat/'.$next);
			}
		}
	}

	public function selesai_ujian()
	{	//Update Jawaban 
        $data = [
        	'status_jawaban' => "Selesai"
        ];

		$this->jawaban->update_jawaban($this->id_peserta, $data);

        return redirect()->to('peserta');
	}

	public function logout()
	{
		session()->destroy();
		return redirect()->to('/');
	}
}