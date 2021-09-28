<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pertanyaan extends Model {

	protected $table      = 'tbl_pertanyaan';
    protected $returnType     = 'array';
    protected $primaryKey     = 'id_pertanyaan';
    protected $allowedFields = [
        'id_soal', 'pertanyaan', 'option_1', 
        'option_2', 'option_3', 'option_4', 
        'option_5', 'jawaban'
    ];

    public function acak_soal($id_soal){ 
		return $this->select('*')
		            ->where('id_soal', $id_soal)
		            ->orderBy('id_pertanyaan', 'random')
                    ->findAll();
	}
    
	public function list_jawaban($id_pertanyaan){
		return $this->select('*')
		            ->join('tbl_soal', 'tbl_soal.id_soal = tbl_pertanyaan.id_soal', 'left')
		            ->where('tbl_pertanyaan.id_pertanyaan', $id_pertanyaan)
		            ->findAll();
	}
}