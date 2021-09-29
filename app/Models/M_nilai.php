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
		            ->where('id_soal', $id_soal)
					->findAll();
	}

	public function getNilai($id){
		return $this->select('tbl_nilai.*, tbl_soal.nama_soal')
					->join('tbl_soal', 'tbl_nilai.id_soal = tbl_soal.id_soal')
					->where('tbl_nilai.id_peserta', $id)
					->findAll();
	}

	public function update_nilai($id_peserta, $id_soal, $nilai){
		$this->db      = \Config\Database::connect();
		$tbl = $this->db->table('tbl_nilai');
		$tbl->where('id_peserta', $id_peserta);
		$tbl->where('id_soal', $id_soal);
		$tbl->update($nilai);
	}
}