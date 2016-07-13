<?php
/**
* 
*/
class Kategori extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['kategori_model', 'prasarana_model']);
	}

	public function index()
	{
		$this->stencil->js(array('jquery.dataTables.min', 'dataTables.bootstrap.min','kategori/kategori.js'));
		$this->stencil->css('dataTables.bootstrap');
		$data['categories'] = $this->kategori_model->get_all()->result();
		
		$this->stencil->paint('kategori/index', $data);
	}

	public function create()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nama', 'Nama Kategori', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE) {
				echo json_encode(array('error' => 0, 'message' => form_error('nama')));
				exit();
			} else {
				$nama = $this->input->post('nama');
				//save to database
				$this->kategori_model->save(array('nama_kategori' => $nama, 'id_pengguna' => $this->session->userdata('id')));
				$this->session->set_flashdata('sukses', 'sukses tambah kategori');
				echo json_encode(array('error' => 1, 'message' => 'sukses tambah kategori', 'url' => site_url('kategori')));
				exit();
			}
		}
		redirect('home');
	}

	public function edit()
	{
		$id = $this->input->post('id');
		if ($id) {
			if ($this->input->is_ajax_request()) {
				$get_data = $this->kategori_model->get_by_id(['id' => $id]);
				if ($get_data) {
					echo json_encode(['error' => 1, 'message' => 'data available.', 'data' => $get_data]);
					exit();
				} else {
					echo json_encode(['error' => 0, 'message' => 'no data found.', 'url' => site_url('kategori')]);
					exit();
				}
			}
		}
		redirect('kategori');
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nama', 'Nama Kategori', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE) {
				echo json_encode(['error' => 0, 'message' => form_error('nama'), 'url' => site_url('kategori')]);
				exit();
			} else {
				$this->kategori_model->update(['nama_kategori' => $this->input->post('nama'), 'id_pengguna' => $this->session->userdata('id')], ['id' => $this->input->post('id_edit')]);
				$message = 'Data berhasil di update.';
				$this->session->set_flashdata('sukses', $message);
				echo json_encode(['error' => 1, 'message' => $message, 'url' => site_url('kategori')]);
				exit();
			}

		}
		
		redirect('kategori');
	}

	public function destroy()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('kategori_id');

			$data = $this->kategori_model->get_by_id(array('id' => $id));
			if ($data) {
				//delete prasarana
				$pra = $this->prasarana_model->get_all(['kategori_id_kategori' => $id]);
				if ($pra->num_rows() > 0) {
					
					$pra_data = $pra->result();
					foreach ($pra_data as $key => $value) {
						$this->prasarana_model->destroy(['kategori_id_kategori' => $value->kategori_id_kategori]);
					}
				}
				//delete kategori
				$this->kategori_model->destroy(array('id' => $id));
				$message = 'sukses menghapus kategori';
				$this->session->set_flashdata('sukses', $message);
				echo json_encode(array('error' => 1, 'message' => $message, 'url' => site_url('kategori')));
				exit();
			} else {
				$message = 'Data kategori tidak ditemukan';
				$this->session->set_flashdata('error', $message);
				echo json_encode(array('error' => 0, 'message' => $message, 'url' => site_url('kategori')));
				exit();
			}
		}
		redirect('home');
	}
}