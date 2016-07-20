<?php

/**
* Class Kerusakan
*/
class Kerusakan extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['kerusakan_model','prasarana_model','pengguna_model']);
	}

	public function index()
	{
		$this->stencil->js(array('jquery.dataTables.min', 'dataTables.bootstrap.min','kerusakan/kerusakan.js'));
		$this->stencil->css('dataTables.bootstrap');
		//check pegawai kantor
		if ($this->session->userdata('status') == 5) {
			$kerusakan = $this->kerusakan_model->get_all('status in (1,3,4,6)')->result();
		}
		if ($this->session->userdata('status') == 3) {
			$kerusakan = $this->kerusakan_model->get_all('status in (5,8)')->result();
		}
		if ($this->session->userdata('status') == 4) {
			$kerusakan = $this->kerusakan_model->get_all('status in (2,7)')->result();
		}
		if ($this->session->userdata('status') == 1) {
			$kerusakan = $this->kerusakan_model->get_all()->result();
		}
		//data prasarana
		if ($kerusakan) {
			foreach ($kerusakan as $key => $value) {
				$nama_pras = $this->prasarana_model->get_by_id(['id' => $value->id_prasarana]);
				if ($nama_pras) {
					$kerusakan[$key]->nama_prasarana = $nama_pras->nama;
				} else {
					$kerusakan[$key]->nama_prasarana = 'Belum dimasukan prasarana';
				}
			}
		}
		
		$data['kerusakan'] = $kerusakan;
		$data['jabatan'] = $this->config->item('status_pengguna');
		$this->stencil->paint('kerusakan/index', $data);
	}

	public function edit()
	{
		$id = $this->input->post('id');
		if ($id) {
			if ($this->input->is_ajax_request()) {
				$get_data = $this->kerusakan_model->get_by_id(['id' => $id]);
				if ($get_data) {
					//get data pengguna
					$pengguna = $this->pengguna_model->get_by_id(['id' => $get_data->id_pengguna]);
					$get_data->nama_pengguna = $pengguna->nama;

					//get data prasarana
					$prasarana = $this->prasarana_model->get_by_id(['id' => $get_data->id_prasarana]);
					$get_data->nama_prasarana = $prasarana->nama;
					echo json_encode(['error' => 1, 'message' => 'data available.', 'data' => $get_data]);
					exit();
				} else {
					echo json_encode(['error' => 0, 'message' => 'no data found.', 'url' => site_url('kerusakan')]);
					exit();
				}
			}
		}
		redirect('kerusakan');
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) {
			
			// $this->form_validation->set_rules('id_edit', 'ID', 'required');
			// $this->form_validation->set_error_delimiters('', '');
			// if ($this->form_validation->run() == FALSE) {
   //              echo json_encode([
   //                  'error' => 0,
   //                  'message' => [
   //                      'nama_edit' => form_error('nama_edit'),
   //                      'notlp_edit' => form_error('notlp_edit'),
   //                      'email_edit' => form_error('email_edit'),
   //                      'alamat_edit' => form_error('alamat_edit'),
   //                  ],
   //                  'url' => site_url('kategori')]);
			// 	exit();
			// } else {
   //              $insert_data = array(
   //                          'nama' => $this->input->post('nama_edit'),
   //                          'notlpn' => $this->input->post('notlp_edit'),
   //                          'alamat' => $this->input->post('alamat_edit'),
   //                          'jenis_kelamin' => $this->input->post('jenis_kelamin_edit'),
   //                          'email' => $this->input->post('email_edit'),
   //                          'status' => $this->input->post('jabatan_edit')
   //                      );
				// $this->pengguna_model->update($insert_data, ['id' => $this->input->post('id_edit')]);
				$id = $this->input->post('id_edit');
				$status = $this->input->post('status_edit');
				$this->kerusakan_model->update(['status' => $status], ['id' => $id]);
				$message = 'Data berhasil di update.';
				$this->session->set_flashdata('sukses', $message);
				echo json_encode(['error' => 1, 'message' => $message, 'url' => site_url('kerusakan')]);
				exit();
			// }

		}

		redirect('kategori');
	}
}