<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jawaban extends Model {

	protected $table      = 'tbl_jawaban';
    protected $returnType     = 'array';
    protected $primaryKey     = 'id_jawaban';
    protected $allowedFields = [
        'id_peserta', 'list_soal', 'list_jawaban', 
        'waktu_mulai', 'waktu_selesai', 'status_jawaban'
    ];

	public function update_jawaban($id, $data){
		$this->db      = \Config\Database::connect();
		$tbl = $this->db->table('tbl_jawaban');
		$tbl->where('id_peserta', $id);
		$tbl->update($data);
	}
}