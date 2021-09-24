<?php

namespace App\Models;

use CodeIgniter\Model;

class M_soal extends Model {

	protected $table      = 'tbl_soal';
    protected $returnType     = 'array';
    protected $allowedFields = [
		'nama_soal', 'jumlah_soal', 'minimal_benar', 
		'total_nilai', 'passing_grade'
	];
}