<?php

namespace App\Models;

use CodeIgniter\Model;

class M_soal extends Model {

	protected $table      		= 'tbl_soal';
    protected $returnType     	= 'array';
    protected $primaryKey     	= 'id_soal';
    protected $allowedFields 	= [
		'id_peminatan', 'nama_soal', 'jumlah_soal', 
		'minimal_benar', 'total_nilai', 'passing_grade'
	];

	public function joinPeminatan(){
		return $this->select('tbl_soal.*, tbl_peminatan.nama_peminatan')
					->join('tbl_peminatan', 'tbl_soal.id_peminatan = tbl_peminatan.id_peminatan')
					->orderBy('tbl_soal.id_peminatan', 'ASC')
					->findAll();
	}
}