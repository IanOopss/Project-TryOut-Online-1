<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class Formasilab extends Admin {
	public function index()
	{
		$this->data['title'] 	= "Formasi Lab";
		$this->data['page'] 		= "formasi_lab";
		
		return view('v_admin/v_app', $this->data);
	}

	public function inputLab()
	{
		$nama_lab 			= ucwords($this->request->getVar('nama_lab'));
		$jumlah_formasi 	= $this->request->getVar('jumlah_formasi');
        $lampiran           = $this->request->getFile('lampiran');

        $file_name = url_title($nama_lab, '_'). '.pdf';

        $lampiran->move('assets/academy/img/uploads/', $file_name);
        
        $data = [
            'nama_lab'  	 => $nama_lab,
            'jumlah_peserta' => $jumlah_peserta,
            'lampiran' 		 => $file_name,
        ];

        $this->peminatan->insert($data);

        return redirect()->to('Admin/FormasiLab');
	}

	public function editLab($id)
	{
		$nama_lab 			= ucwords($this->request->getVar('nama_lab'));
		$jumlah_formasi 	= $this->request->getVar('jumlah_formasi');
        $lampiran           = $this->request->getFile('lampiran');

        $old_data = $this->peminatan->find($id);
        $old_file = $old_data['lampiran'];
        
        if($nama_lab != $old_data['nama_lab'] && $lampiran->getError() == 4) {
            $new_file = url_title($nama_lab, '_'). '.pdf';
            rename('assets/academy/img/uploads/' .$old_file, 'assets/academy/img/uploads/' .$new_file);
            $file_name = $new_file;
        }

		if($lampiran->getError() == 4) {
			$file_name = $old_file;
		} else{
			unlink('assets/academy/img/uploads/' .$old_file);
            
            $file_name = url_title($nama_lab, '_'). '.pdf';
            $lampiran->move('assets/academy/img/uploads/', $file_name);
		}

        $data = array(
            'nama_lab'       => $nama_lab,
            'jumlah_formasi' => $jumlah_formasi,
            'lampiran'       => $file_name,
        );
        
        $this->peminatan->update($id, $data);

        return redirect()->to('Admin/FormasiLab');
	}

	public function deleteLab($id)
	{
        $dokumen = $this->peminatan->select('lampiran')->find($id);
        unlink('assets/academy/img/uploads/' .$dokumen['lampiran']);
		$this->peminatan->delete($id);
		return redirect()->to('Admin/FormasiLab');
	}
}
