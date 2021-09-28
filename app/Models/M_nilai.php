<?php

namespace App\Models;

use CodeIgniter\Model;

class M_nilai extends Model {

	protected $table      = 'tbl_nilai';
    protected $returnType     = 'array';
    protected $primaryKey     = 'id_nilai';
    protected $allowedFields = ['id_peserta', 'id_soal', 'nilai_peserta'];
    
	public function cek_nilai($id_peserta, $id_soal){
		return $this->where('id_peserta', $id_peserta)
		            ->find($id_soal);
	}

	public function update_nilai($id_peserta, $id_soal, $nilai){
		$this->where('id_peserta', $id_peserta)
		    ->where('id_soal ', $id_soal)
		    ->update('tbl_nilai', $nilai);	
	}
}