<?php

namespace App\Models;

use CodeIgniter\Model;

class M_nilai extends Model {

	protected $table      = 'tbl_nilai';
    protected $returnType     = 'array';
    protected $allowedFields = ['id_peserta', 'id_soal', 'nilai_peserta'];

}