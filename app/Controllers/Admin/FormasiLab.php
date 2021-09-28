<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class Formasilab extends Admin {
	public function index()
	{
		$data['title'] 	= "Formasi Lab";
		$data['page'] 		= "formasi_lab";

		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll();
		
		return view('v_admin/v_app', $data);
	}

	public function inputLab()
	{
		$nama_lab 			= ucwords($this->request->getVar('nama_lab'));
		$jumlah_formasi 	= $this->request->getVar('jumlah_formasi');
        $lampiran           = $this->request->getFile('lampiran');

        $file_name = url_title($nama_lab, '_'). '.pdf';

        $lampiran->move('assets/academy/img/uploads/', $file_name);
        
        $data = [
            'nama_lab'  => $nama_lab,
            'jumlah_formasi' 	=> $jumlah_formasi,
            'lampiran' => $file_name,
        ];

        $this->lab->insert($data);

        return redirect()->to('Admin/FormasiLab');
	}

	public function editLab($id)
	{
		$nama_lab 			= ucwords($this->request->getVar('nama_lab'));
		$jumlah_formasi 	= $this->request->getVar('jumlah_formasi');
        $lampiran           = $this->request->getFile('lampiran');

        $old_data = $this->lab->find($id);
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
        
        $this->lab->update($id, $data);

        return redirect()->to('Admin/FormasiLab');
	}

	public function deleteLab($id)
	{
        $dokumen = $this->lab->select('lampiran')->find($id);
        unlink('assets/academy/img/uploads/' .$dokumen['lampiran']);
		$this->lab->delete($id);
		return redirect()->to('Admin/FormasiLab');
	}

	public function download($nama){
		$nama_files = $nama; 
		$download = 'uploads/pengumuman/';
		if (!file_exists($download.$nama_files)) {
		  $error =  "<h3>Access forbidden!</h3>
		      <p> Anda tidak diperbolehkan mendownload file ini.</p>";
		  $this->session->set_flashdata('warning', $error);
		  return redirect()->to('Admin/FormasiLab');
		}else{

		header("Content-Type: octet/stream");
  		header("Content-Disposition: attachment; filename=\"".$nama_files."\"");
  		$fp = fopen($download.$nama_files, "r");
  		$data = fread($fp, filesize($download.$nama_files));
  		fclose($fp);
  		print $data;
  		}
	}
}
