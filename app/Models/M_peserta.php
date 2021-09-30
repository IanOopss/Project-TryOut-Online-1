<?php

namespace App\Models;

use CodeIgniter\Model;

class M_peserta extends Model {

	protected $table            = 'tbl_peserta';
    protected $returnType       = 'array';
    protected $primaryKey       = 'id_peserta';
    protected $allowedFields    = [
        'id_peminatan', 'email', 'password_peserta', 
        'nama_peserta', 'jenis_kelamin', 'no_hp', 'foto', 'bukti_pembayaran', 
        'tgl_selesai_pendaftaran', 'status_pendaftaran', 'status_verifikasi'
    ];

	public function cek_peserta($email){
		return $this->where('email', $email)->first();
	}

    public function nilaiPeserta($id){
        return $this->select('*')
		            ->join('tbl_jawaban', 'tbl_jawaban.id_peserta = tbl_peserta.id_peserta', 'left')
		            ->where('tbl_jawaban.status_jawaban', 'Selesai')
		            ->where('tbl_peserta.id_peminatan', $id)
                    ->findAll();
    }
}