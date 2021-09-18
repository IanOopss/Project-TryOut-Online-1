<?php

namespace App\Models;

use CodeIgniter\Model;

class M_admin extends Model {

	protected $table      = 'tbl_admin';
    protected $returnType     = 'array';
    protected $allowedFields = ['username', 'password', 'level_admin', 'nama'];
	
	public function cek_panitia($username)
	{
		return $this->where('username', $username)->first();
	}
}