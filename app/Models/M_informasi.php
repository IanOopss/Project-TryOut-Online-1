<?php

namespace App\Models;

use CodeIgniter\Model;

class M_informasi extends Model {

	protected $table      = 'tbl_informasi';
    protected $returnType     = 'array';
    protected $allowedFields = ['nama_kegiatan', 'tgl_pendaftaran', 'tgl_tutup', 'tgl_ujian_cat', 'waktu_pengerjaan', 'alur_pendaftaran'];

	public function data_informasi(){
		return $this->findAll();
	}
}