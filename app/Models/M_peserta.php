<?php

namespace App\Models;

use CodeIgniter\Model;

class M_peserta extends Model {

	protected $table            = 'tbl_peserta';
    protected $returnType       = 'array';
    protected $primaryKey       = 'id_peserta';
    protected $allowedFields    = [
        'id_lab', 'nim', 'password_peserta', 
        'nama_peserta', 'ipk', 'tmp_lahir', 
        'tgl_lahir', 'jenis_kelamin', 'agama', 
        'no_hp', 'email', 'foto', 'berkas_peserta', 
        'tgl_selesai_pendaftaran', 'status_pendaftaran', 'status_verifikasi'
    ];

	public function cek_peserta($nim){
		return $this->where('nim', $nim)->first();
	}

    public function nilaiPeserta($id_lab){
        return $this->select('*')
		            ->join('tbl_jawaban', 'tbl_jawaban.id_peserta = tbl_peserta.id_peserta', 'left')
		            ->where('tbl_jawaban.status_jawaban', 'Selesai')
		            ->where('tbl_peserta.id_lab', $id_lab)
                    ->findAll();
    }
}