<?php
/**
* 
*/
class Kategori extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model');
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
				$this->kategori_model->save(array('nama_kategori' => $nama));
				$this->session->set_flashdata('sukses', 'sukses tambah kategori');
				echo json_encode(array('error' => 1, 'message' => 'sukses tambah kategori', 'url' => site_url('kategori')));
				exit();
			}
		}
		redirect('home');
	}

	public function destroy()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('kategori_id');

			$data = $this->kategori_model->get_by_id(array('id' => $id));
			if ($data) {
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