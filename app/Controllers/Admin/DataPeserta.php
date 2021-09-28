<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;
use TCPDF;

class DataPeserta extends Admin
{
	private function berkas($id_lab, $berkas)
	{ 
		return $link = "
			<a href='".base_url('data_peserta/download/'.$id_lab.'/'.$berkas)."'>
                <p align='center'><i class='fa fa-file'></i></p>
            </a>";
	}

	private function action($id_lab, $id_peserta, $status_verifikasi)
	{ 
		if ($status_verifikasi == "Belum") {
			$link = "
				<a href='".base_url('Admin/DataPeserta/view/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-primary btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>

		      	<a href='".base_url('Admin/DataPeserta/lulus/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='Lulus'>
		      		<button type='button' class='btn btn-success btn-xs'><i class='fa fa-check-square-o'></i></button>
		      	</a>

		      	<a href='".base_url('Admin/DataPeserta/tidak_lulus/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='Tidak Lulus'>
		      		<button type='button' class='btn btn-danger btn-xs'><i class='fa  fa-close'></i></button>
		      	</a>";
		}
		elseif ($status_verifikasi == "Lulus"){
			$link = "
				<a href='".base_url('Admin/DataPeserta/view/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-success btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>
	   		 ";

		}
		else{
			$link = "
				<a href='".base_url('Admin/DataPeserta/view/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-warning btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>
	   		 ";
		}
		
	    return $link;
	}

	public function formasi($id_lab)
	{
		$data['title'] 	= "Data Peserta";
		$data['page'] 		= "data_peserta";

		//Side Menu
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal']  = $this->soal->findAll();

		// Nama Formasi Lab
		$data['cek_lab'] = $this->lab->where('id_lab', $id_lab)->first();
		
		$data['kode1'] = $id_lab;
		
		return view('v_admin/v_app', $data);
	}

	public function view($id_lab, $id_peserta)
	{
		$data['title'] 	= "Data Peserta";
		$data['page'] 	= "view_peserta";

		//Side Menu
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] 	= $this->soal->findAll();

		// Nama Formasi Lab
		$data['cek_lab'] = $this->lab->where('id_lab', $id_lab)->first();

		// View Peserta
		$data['view_peserta'] = $this->peserta->where('id_peserta', $id_peserta)->first();

		return view('v_admin/v_app', $data);
	}

	public function lulus($id_lab, $id_peserta)
	{
		$cek_formasi =  $this->lab->where('id_lab', $id_lab)->first();
		
		$jumlah_lulus_adm = $cek_formasi['jumlah_lulus_adm'];
		
		$lab = [
			'jumlah_lulus_adm' => $jumlah_lulus_adm+1
		];

		$this->lab->update($id_lab, $lab);
		
		$data = [
			'status_verifikasi' => "Lulus"
		];

		$this->peserta->update($id_peserta, $data);

		return redirect()->to('Admin/DataPeserta/formasi/'.$id_lab);
	}

	public function tidak_lulus($id_lab, $id_peserta)
	{
		$data = [
			'status_verifikasi' => "Tidak Lulus"
		];

		$this->peserta->update($id_peserta, $data);

		return redirect()->to('Admin/DataPeserta/formasi/'.$id_lab);
	}

	public function cetak($id_lab)
	{	
		$data['title'] 	= "Data Peserta Report";
		$data['page'] 		= "cetak_peserta";

		//Side Menu
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] 	= $this->soal->findAll();

		//Nama Formasi Lab
		$data['cek_lab'] = $this->lab->where('id_lab', $id_lab)->first();
		
		// Cetak
		$data['cetak_peserta'] = $this->peserta->where('id_lab', $id_lab)->findAll();
		
		return view('v_admin/data_peserta/v_cetak', $data);
	}

	public function download($id_lab, $berkas){
		$nama_files = $berkas; 
		$download = 'uploads/berkas_peserta/';
		if (!file_exists($download.$nama_files)) {
		  $error =  "<h3>Access forbidden!</h3>
		      <p> Anda tidak diperbolehkan mendownload file ini.</p>";
		  $this->session->set_flashdata('warning', $error);
		  return redirect()->to('Admin/DataPeserta/formasi/'.$id_lab);
		}else{

		header("Content-Type: octet/stream");
  		header("Content-Disposition: attachment; filename=\"".$nama_files."\"");
  		$fp = fopen($download.$nama_files, "r");
  		$data = fread($fp, filesize($download.$nama_files));
  		fclose($fp);
  		print $data;
  		}
	}

	/*
	| -------------------------------------------------------------------
	| SERVER SIDE -------------------------------------------------------
	| -------------------------------------------------------------------
	*/

	public function ajax_get_peserta($id_lab){
		$list = $this->peserta->where('id_lab', $id_lab)->findAll();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $personal) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $personal['nim'];
			$row[] = $personal['nama_peserta'];
			$row[] = $personal['ipk'];
			$row[] = $this->berkas($id_lab, $personal['berkas_peserta']);
			$row[] = tgl_indonesia($personal['tgl_selesai_pendaftaran']);
			$row[] = $personal['status_verifikasi'];
			$row[] = $this->action($id_lab, $personal['id_peserta'], $personal['status_verifikasi']);

			$data[] = $row; 
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->peserta->where('id_lab', $id_lab)->countAllResults(),
			"recordsFiltered" 	=> '10',
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}
}