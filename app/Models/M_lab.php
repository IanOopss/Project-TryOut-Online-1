<?php

namespace App\Models;

use CodeIgniter\Model;

class M_lab extends Model {

	protected $table      = 'tbl_lab';
    protected $returnType     = 'array';
    protected $allowedFields = ['nama_lab', 'jumlah_formasi', 'jumlah_peserta', 'jumlah_lulus_adm', 'lampiran'];

    
	public function data_formasi_lab(){
		return $this->findAll();
		
	}

	public function cek_formasi_lab($id_lab){
		$this->db->where('id_lab', $id_lab);
		return $this->db->get('tbl_lab');
		
	}
	
	public function input_formasi_lab($data){
		$this->db->insert('tbl_lab', $data);
		
	}

	public function update_formasi_lab($data, $id_lab){
		$this->db->where('id_lab', $id_lab);
		$this->db->update('tbl_lab', $data);
		
	}
	
	public function delete_formasi_lab($id_lab){
		$this->db->where('id_lab', $id_lab);
		$this->db->delete('tbl_lab');
		
	}
	
}