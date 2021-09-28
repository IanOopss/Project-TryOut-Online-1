<?php

namespace App\Models;

use CodeIgniter\Model;

class M_informasi extends Model {

	protected $table      	 = 'tbl_informasi';
    protected $returnType    = 'array';
	protected $primaryKey 	 = 'id_informasi';
    protected $allowedFields = [
		'nama_kegiatan', 'tgl_pendaftaran', 'tgl_tutup', 'tgl_lulus_adm',
		'tgl_ujian_cat', 'waktu_pengerjaan', 'alur_pendaftaran'
	];
}