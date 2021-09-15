<?php

class M_informasi extends CI_model {

	public function data_informasi(){
		return $this->db->get('tbl_informasi');
		
	}

	public function update_informasi($data, $id_informasi){
		$this->db->where('id_informasi', $id_informasi);
		$this->db->update('tbl_informasi', $data);
		
	}
	
}
