<?php

namespace App\Models;

use CodeIgniter\Model;

class M_lab extends Model {

	protected $table      	  = 'tbl_lab';
    protected $returnType     = 'array';
    protected $primaryKey     = 'id_lab';
    protected $allowedFields  = [
		'nama_lab', 'jumlah_formasi', 'jumlah_peserta', 
		'jumlah_lulus_adm', 'lampiran'
	];
}