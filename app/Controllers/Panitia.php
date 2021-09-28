<?php
namespace App\Controllers;

class Panitia extends BaseController
{
    public function index(){
        $data['title'] 	= "Dashboard Panitia";
		$data['page'] 		= "dashboard_panitia";

		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll();

		$data['lab'] = $this->lab->countAllResults();
		$data['soal'] = $this->soal->countAllResults();
		$data['pertanyaan'] = $this->pertanyaan->countAllResults();
		$data['peserta'] = $this->peserta->countAllResults();
		
		return view('v_admin/v_app', $data);
	}

	public function edit()
	{
		$data['title'] 	= "Panitia Settings";
		$data['page'] 		= "panitia_edit";
		
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll();

        $data['password'] = $this->encryption->decrypt(base64_decode(session()->get('password')));
		
		return view('v_admin/v_app', $data);
	}

	public function edit_password($id_admin)
	{

		$this->form_validation->set_rules('new_password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('comfirm_password', 'Comfirm Password', 'trim|required|min_length[8]|matches[new_password]');
		
		if($this->form_validation->run() == FALSE) {

			$data = array(
				'warning' => validation_errors() 
				);

			$this->session->set_flashdata($data); 
	
			return redirect()->to('panitia/edit');

		}else{

		 	$password 	= $this->input->post('new_password');

		 	$data = array(
			'password' => $this->encryption->encrypt($password)
			);

			$simpan = $this->M_panitia->update_panitia($data, $id_admin);		
			
			if(!$simpan) {
				$this->session->set_flashdata('success', 'Password Berhasil diperbarui.');
				return redirect()->to('panitia');
			} else {
				$this->session->set_flashdata('warning', 'Password Gagal diperbarui.');
				return redirect()->to('panitia');
			}
 			
 		}
	}
}