<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class DataPeserta extends Admin
{
	private function berkas($nama_folder, $berkas)
	{ 
		return "
			<a href='".base_url('/assets/academy/img/uploads/berkas_peserta/' .$nama_folder. '/' .$berkas)."' target='_blank'>
				<p align='center'><i class='fa fa-file'></i></p>
			</a>";
	}

	private function action($id_peminatan, $id_peserta, $status_verifikasi)
	{ 
		if ($status_verifikasi == "Belum") {
			$link = "
				<a href='".base_url('Admin/DataPeserta/view/'.$id_peminatan.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-primary btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>

		      	<a href='".base_url('Admin/DataPeserta/lulus/'.$id_peminatan.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='Lulus'>
		      		<button type='button' class='btn btn-success btn-xs'><i class='fa fa-check-square-o'></i></button>
		      	</a>

		      	<a href='".base_url('Admin/DataPeserta/tidak_lulus/'.$id_peminatan.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='Tidak Lulus'>
		      		<button type='button' class='btn btn-danger btn-xs'><i class='fa  fa-close'></i></button>
		      	</a>";
		}
		elseif ($status_verifikasi == "Lulus"){
			$link = "
				<a href='".base_url('Admin/DataPeserta/view/'.$id_peminatan.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-success btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>";
		}
		else{
			$link = "
				<a href='".base_url('Admin/DataPeserta/view/'.$id_peminatan.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-warning btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>";
		}
		
	    return $link;
	}

	public function formasi($id_peminatan)
	{
		$this->data['title'] 	= "Data Peserta";
		$this->data['page'] 		= "data_peserta";

		// Nama Formasi Lab
		$this->data['cek_peminatan'] = $this->peminatan->where('id_peminatan', $id_peminatan)->first();
		
		$this->data['kode1'] = $id_peminatan;

		return view('v_admin/v_app', $this->data);
	}

	public function view($id_peminatan, $id_peserta)
	{
		$this->data['title'] 	= "Data Peserta";
		$this->data['page'] 	= "view_peserta";

		// Nama Formasi Lab
		$this->data['cek_lab'] = $this->peminatan->where('id_peminatan', $id_peminatan)->first();

		// View Peserta
		$this->data['view_peserta'] = $this->peserta->where('id_peserta', $id_peserta)->first();

		return view('v_admin/v_app', $this->data);
	}

	public function lulus($id_peminatan, $id_peserta)
	{
		$email_peserta = $this->peserta->find($id_peserta)['email'];
		
		$email = \Config\Services::email();

		$email->setFrom('dummysender123789@gmail.com', 'Pengirim Email');
		$email->setTo($email_peserta);
		$email->setCC('dummysender123789@gmail.com');

		$email->setSubject('Anda Lulus');
		$email->setMessage('Selamat anda telah lulus verifikasi pendaftaran, anda dapat melakukan ujian tryout pada tanggal XX-XX-XXXX.');

		$email->send();

		$data = [
			'status_verifikasi' => "Lulus"
		];
		
		$this->peserta->update($id_peserta, $data);

		return redirect()->to('Admin/DataPeserta/formasi/'.$id_peminatan);
	}

	public function tidak_lulus($id_peminatan, $id_peserta)
	{
		$data = [
			'status_verifikasi' => "Tidak Lulus"
		];

		$this->peserta->update($id_peserta, $data);

		return redirect()->to('Admin/DataPeserta/formasi/'.$id_peminatan);
	}

	public function cetak($id_peminatan)
	{	
		$this->data['title'] 	= "Data Peserta Report";
		$this->data['page'] 		= "cetak_peserta";

		//Nama Formasi Lab
		$this->data['cek_lab'] = $this->peminatan->where('id_peminatan', $id_peminatan)->first();
		
		// Cetak
		$this->data['cetak_peserta'] = $this->peserta->where('id_peminatan', $id_peminatan)->findAll();
		
		return view('v_admin/data_peserta/v_cetak', $this->data);
	}
	
	/*
	| -------------------------------------------------------------------
	| SERVER SIDE -------------------------------------------------------
	| -------------------------------------------------------------------
	*/

	public function ajax_get_peserta($id_peminatan){
		$list = $this->peserta->where('id_peminatan', $id_peminatan)->findAll();
		$peminatan = $this->peminatan->where('id_peminatan', $id_peminatan)->first();

		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $personal) {
			$no++;
			$nama_folder = $personal['id_peserta']. '_' .url_title($personal['nama_peserta'], '_', true);

			$row = array();
			$row[] = $no;
			$row[] = $personal['nama_peserta'];
			$row[] = $personal['email'];
			$row[] = $peminatan['nama_peminatan'];
			$row[] = $this->berkas($nama_folder, $personal['bukti_pembayaran']);
			$row[] = tgl_indonesia($personal['tgl_selesai_pendaftaran']);
			$row[] = $personal['status_verifikasi'];
			$row[] = $this->action($id_peminatan, $personal['id_peserta'], $personal['status_verifikasi']);

			$data[] = $row; 
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->peserta->where('id_peminatan', $id_peminatan)->countAllResults(),
			"recordsFiltered" 	=> '10',
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}
}