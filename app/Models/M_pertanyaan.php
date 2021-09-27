<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pertanyaan extends Model {

	protected $table      = 'tbl_pertanyaan';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'id_soal', 'pertanyaan', 'option_1', 
        'option_2', 'option_3', 'option_4', 
        'option_5', 'jawaban'
    ];

}