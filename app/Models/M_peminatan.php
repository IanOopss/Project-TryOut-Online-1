<?php

namespace App\Models;

use CodeIgniter\Model;

class M_peminatan extends Model {

	protected $table      	  = 'tbl_peminatan';
    protected $returnType     = 'array';
    protected $primaryKey     = 'id_peminatan';
    protected $allowedFields  = [
		'nama_peminatan', 'jumlah_peserta', 'waktu_pengerjaan'
	];
}