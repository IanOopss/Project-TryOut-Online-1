<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jawaban extends Model {

	protected $table      = 'tbl_jawaban';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'id_peserta', 'list_soal', 'list_jawaban', 
        'waktu_mulai', 'waktu_selesai', 'status_jawaban'
    ];

}