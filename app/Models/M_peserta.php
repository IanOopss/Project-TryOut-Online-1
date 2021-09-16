<?php

namespace App\Models;

use CodeIgniter\Model;

class M_peserta extends Model {

	protected $table      = 'tbl_peserta';
    protected $returnType     = 'array';
    protected $allowedFields = ['id_lab', 'nim', 'password_peserta', 'nama_peserta', 'ipk', 'tmp_lahir', 'tgl_lahir', 'jenis_kelamin', 'agama', 'no_hp', 'email', 'foto', 'berkas_peserta', 'tgl_selesai_pendaftaran', 'status_pendaftaran', 'status_verifikasi'];

}