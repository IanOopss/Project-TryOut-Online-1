<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class InformasiPendaftaran extends Admin
{
	public function index()
	{
		$this->data['title'] 	= "Informasi Pendaftaran";
		$this->data['page'] 		= "informasi_pendaftaran";
		
		$this->data['informasi'] 	    = $this->informasi->findAll();
		
		return view('v_admin/v_app', $this->data);
	}

	public function editInformasi($id)
	{
		$nama_kegiatan		= $this->request->getVar('nama_kegiatan');
		$tgl_pendaftaran 	= explode(" - ", $this->request->getVar('tgl_pendaftaran'));
		$tgl_lulus_adm		= ubah_tgl($this->request->getVar('tgl_lulus_adm'));
		$tgl_ujian_cat		= ubah_tgl($this->request->getVar('tgl_ujian_cat'));
		$waktu_pengerjaan	= $this->request->getVar('waktu_pengerjaan');
		$old_img			= $this->request->getVar('old_img');
		
		$img = $this->request->getFile('alur_pendaftaran');
		
		$tgl1 = ubah_tgl($tgl_pendaftaran[0]);
		$tgl2 = ubah_tgl($tgl_pendaftaran[1]);
		
		if($img->getError() == 4) {
			$gambar_alur = $old_img;
		} else{
			$gambar_alur = $img->getRandomName();

			unlink('assets/academy/img/uploads/' .$old_img);

			$img->move('assets/academy/img/uploads/', $gambar_alur);
		}
		
		$data= [
			'nama_kegiatan' => $nama_kegiatan,
			'tgl_pendaftaran' => $tgl1,
			'tgl_tutup' => $tgl2,
			'tgl_lulus_adm' => $tgl_lulus_adm,
			'tgl_ujian_cat' => $tgl_ujian_cat,
			'waktu_pengerjaan' => $waktu_pengerjaan,
			'alur_pendaftaran' => $gambar_alur,
		];
		
		$this->informasi->update($id, $data);

		return redirect()->to('Admin/InformasiPendaftaran');
	}
}