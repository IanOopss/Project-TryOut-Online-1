<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_peserta extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('level_admin'))
		{
			redirect('access_denied');
		}
	}

    private function berkas($id_lab, $berkas)
	{ 
		$link = "
			<a href='".base_url('data_peserta/download/'.$id_lab.'/'.$berkas)."'>
                <p align='center'><i class='fa fa-file'></i></p>
            </a>
	    ";
	    return $link;
	}

	private function action($id_lab, $id_peserta, $status_verifikasi)
	{ 
		if ($status_verifikasi == "Belum") {
			$link = "
				<a href='".base_url('data_peserta/view/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-primary btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>

		      	<a href='".base_url('data_peserta/lulus/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='Lulus'>
		      		<button type='button' class='btn btn-success btn-xs'><i class='fa fa-check-square-o'></i></button>
		      	</a>

		      	<a href='".base_url('data_peserta/tidak_lulus/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='Tidak Lulus'>
		      		<button type='button' class='btn btn-danger btn-xs'><i class='fa  fa-close'></i></button>
		      	</a>
	   		 ";
		}
		elseif ($status_verifikasi == "Lulus"){
			$link = "
				<a href='".base_url('data_peserta/view/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-success btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>
	   		 ";

		}
		else{
			$link = "
				<a href='".base_url('data_peserta/view/'.$id_lab.'/'.$id_peserta)."' data-toggle='tooltip' data-placement='top' title='View'>
		      		<button type='button' class='btn btn-warning btn-xs'><i class='fa fa-binoculars'></i></button>
		      	</a>
	   		 ";

		}
		
	    return $link;
	}

	public function formasi($id_lab)
	{
		$data ['title'] 	= "Data Peserta";
		$data ['page'] 		= "data_peserta";

		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();

		//Side Menu
		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] 	= $this->M_jenis_soal->data_jenis_soal()->result();

		// Nama Formasi Lab
		$data ['cek_lab'] = $this->M_formasi_lab->cek_formasi_lab($id_lab)->result();
		
		$data ['kode1'] = $id_lab;

		$this->load->view('v_admin/v_app', $data);
	}

	public function view($id_lab, $id_peserta)
	{
		$data ['title'] 	= "Data Peserta";
		$data ['page'] 		= "view_peserta";

		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();

		//Side Menu
		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] 	= $this->M_jenis_soal->data_jenis_soal()->result();

		// Nama Formasi Lab
		$data ['cek_lab'] = $this->M_formasi_lab->cek_formasi_lab($id_lab)->result();

		// View Peserta
		$data ['view_peserta'] = $this->M_peserta->paserta_id($id_peserta)->result();
		
		$this->load->view('v_admin/v_app', $data);
	}

	public function lulus($id_lab, $id_peserta)
	{
		$cek_formasi =  $this->M_formasi_lab->cek_formasi_lab($id_lab)->result();
		foreach ($cek_formasi as $key) {
		 	$jumlah_lulus_adm = $key->jumlah_lulus_adm;
		 } 
		
		$lab = [
			'jumlah_lulus_adm' => $jumlah_lulus_adm+1
			];
		$this->M_formasi_lab->update_formasi_lab($lab, $id_lab);
		
		$data = [
			'status_verifikasi' => "Lulus"
			];

		$this->M_peserta->update_paserta($data, $id_peserta);
		$this->session->set_flashdata('success', 'Verifikasi Berhasil dilakukan');
			redirect('data_peserta/formasi/'.$id_lab);

	}

	public function tidak_lulus($id_lab, $id_peserta)
	{
		$data = [
			'status_verifikasi' => "Tidak Lulus"
			];
		$this->M_peserta->update_paserta($data, $id_peserta);
		$this->session->set_flashdata('success', 'Verifikasi Berhasil dilakukan');
			redirect('data_peserta/formasi/'.$id_lab);

	}

	public function cetak($id_lab)
	{	
		$data ['title'] 	= "Data Peserta Report";
		$data ['page'] 		= "cetak_peserta";

		$id_admin		= $this->session->userdata('id_admin');
		$data ['user']	= $this->M_panitia->get_panitia($id_admin)->result();

		//Side Menu
		$data ['formasi_lab'] = $this->M_formasi_lab->data_formasi_lab()->result();
		$data ['jenis_soal'] 	= $this->M_jenis_soal->data_jenis_soal()->result();

		//Nama Formasi Lab
		$data ['cek_lab'] = $this->M_formasi_lab->cek_formasi_lab($id_lab)->result();
		
		// Cetak
		$data ['cetak_peserta'] = $this->M_peserta->cetak_peserta($id_lab)->result();

		$this->load->view('v_admin/data_peserta/v_cetak', $data);
		
	}

	public function download($id_lab, $berkas){
		$nama_files = $berkas; 
		$download = 'uploads/berkas_peserta/';
		if (!file_exists($download.$nama_files)) {
		  $error =  "<h3>Access forbidden!</h3>
		      <p> Anda tidak diperbolehkan mendownload file ini.</p>";
		  $this->session->set_flashdata('warning', $error);
		  redirect('data_peserta/formasi/'.$id_lab);
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
		$list = $this->M_peserta->get_peserta($id_lab);
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $personal) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $personal->nim;
			$row[] = $personal->nama_peserta;
			$row[] = $personal->ipk;
			$row[] = $this->berkas($id_lab, $personal->berkas_peserta);
			$row[] = tgl_indonesia($personal->tgl_selesai_pendaftaran);
			$row[] = $personal->status_verifikasi;
			$row[] = $this->action($id_lab, $personal->id_peserta, $personal->status_verifikasi);

			$data[] = $row; 
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->M_peserta->count_all($id_lab),
			"recordsFiltered" 	=> $this->M_peserta->count_filtered($id_lab),
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}

}
