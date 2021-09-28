<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\Admin;

class PertanyaanSoal extends Admin
{   
    private function action($id_soal,$id_pertanyaan)
	{ 
		return $link = "
			<a href='".base_url('Admin/PertanyaanSoal/editSoal/'.$id_soal.'/'.$id_pertanyaan)."' data-toggle='tooltip' data-placement='top' title='Edit'>
	      		<button type='button' class='btn btn-success btn-xs'><i class='fa fa-edit'></i></button>
	      	</a>
	      
	      	<a href='".base_url('Admin/PertanyaanSoal/deleteSoal/'.$id_soal.'/'.$id_pertanyaan)."' data-toggle='tooltip' data-placement='top' title='Delete' onclick='Hapus Data Pertanyaan'>
	      		<button type='button' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></button>
	      	</a> ";
	}

	public function soal($id_soal)
	{
		$data['title'] 	= "Soal";
		$data['page'] 	= "pertanyaan_soal";

		//Sidebar
		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll(); 
		
		$data['kode1'] = $id_soal;

		$data['nama_soal'] = $this->soal->find($id_soal);
		$data['data_pertanyaan'] = $this->pertanyaan->where('id_soal', $id_soal)->countAllResults();

		return view('v_admin/v_app', $data);
	}

	public function inputSoal($id_soal)
	{
		$pertanyaan = $this->request->getVar('pertanyaan');
		$option_1 = $this->request->getVar('option_1');
		$option_2 = $this->request->getVar('option_2');
		$option_3 = $this->request->getVar('option_3');
		$option_4 = $this->request->getVar('option_4');
		$option_5 = $this->request->getVar('option_5');
		$jawaban = $this->request->getVar('jawaban');

		$data = [ 
			'id_soal' => $id_soal,
			'pertanyaan' => $pertanyaan,
			'option_1' => $option_1,
			'option_2' => $option_2,
			'option_3' => $option_3,
			'option_4' => $option_4,
			'option_5' => $option_5,
			'jawaban' => $jawaban
		];
		
		$this->pertanyaan->insert($data);

		return redirect()->to('Admin/PertanyaanSoal/soal/'.$id_soal);
	}

	public function editSoal($id_soal,$id_pertanyaan)
	{
		$data['title'] 	= "Edit Soal";
		$data['page'] 		= "pertanyaan_edit";

		$data['formasi_lab'] = $this->lab->findAll();
		$data['jenis_soal'] = $this->soal->findAll();
		
		$data['kode1'] = $id_soal;

		$data['nama_soal'] = $this->soal->where('id_soal', $id_soal)->first();
		$data['tampil_edit'] = $this->pertanyaan->where('id_pertanyaan', $id_pertanyaan)->first();

		return view('v_admin/v_app', $data);
	}

	public function edit_proses($id_soal,$id_pertanyaan)
	{
		$pertanyaan = $this->request->getVar('pertanyaan');
		$option_1 = $this->request->getVar('option_1');
		$option_2 = $this->request->getVar('option_2');
		$option_3 = $this->request->getVar('option_3');
		$option_4 = $this->request->getVar('option_4');
		$option_5 = $this->request->getVar('option_5');
		$jawaban = $this->request->getVar('jawaban');

		$data = [ 
			'pertanyaan' => $pertanyaan,
			'option_1' => $option_1,
			'option_2' => $option_2,
			'option_3' => $option_3,
			'option_4' => $option_4,
			'option_5' => $option_5,
			'jawaban' => $jawaban
		];
		
		$this->pertanyaan->update($id_pertanyaan, $data);

		return redirect()->to('Admin/PertanyaanSoal/soal/'.$id_soal);
	}
	

	public function deleteSoal($id_soal,$id_pertanyaan)
	{
		$this->pertanyaan->delete($id_pertanyaan);
		return redirect()->to('Admin/PertanyaanSoal/soal/'.$id_soal);
	}

	/*
	| -------------------------------------------------------------------
	| SERVER SIDE -------------------------------------------------------
	| -------------------------------------------------------------------
	*/

	public function ajax_get_pertanyaan($id_soal){
		$list = $this->pertanyaan->where('id_soal', $id_soal)->findAll();
		$data = array();
		$no = $_POST['start'];
		
		foreach ($list as $personal) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $personal['pertanyaan'];
			$row[] = $personal['option_1'];
			$row[] = $personal['option_2'];
			$row[] = $personal['option_3'];
			$row[] = $personal['option_4'];
			$row[] = $personal['option_5'];
			$row[] = $personal['jawaban'];
			$row[] = $this->action($id_soal, $personal['id_pertanyaan']);

			$data[] = $row; 
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->pertanyaan->where('id_soal', $id_soal)->countAllResults(),
			"recordsFiltered" 	=> '10',
			"data" 				=> $data,
		);
		
		//output to json format
		echo json_encode($output);
	}
}