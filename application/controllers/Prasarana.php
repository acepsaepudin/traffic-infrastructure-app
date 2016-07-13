<?php
class Prasarana extends MY_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->model([
            'Prasarana_model',
            'Kategori_model',
        ]);
	}

    public function index()
    {
        $this->stencil->js(array('jquery.dataTables.min', 'dataTables.bootstrap.min','prasarana/prasarana.js'));
		$this->stencil->css('dataTables.bootstrap');
		$prasarana = $this->Prasarana_model->get_all()->result();
		//reformat data
		if ($prasarana) {
			foreach ($prasarana as $key => $value) {
				$prasarana[$key]->kategori = $this->Kategori_model->get_by_id(['id' => $value->kategori_id_kategori])->nama_kategori;
			}
		}
		$data['prasarana'] = $prasarana;
	    $data['kategori'] = $this->Kategori_model->get_all()->result();	
		$this->stencil->paint('prasarana/index', $data);
 
    }

	public function create()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
			$this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
			$this->form_validation->set_rules('latitude', 'Latitude', 'required');
			$this->form_validation->set_rules('longitude', 'Longitude', 'required');
			$this->form_validation->set_rules('kategori', 'Nama Kategori', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'error' => 0,
                    'message' => array(
                        'nama' => form_error('nama'),
                        'lokasi' => form_error('lokasi'),
                        'latitude' => form_error('latitude'),
                        'longitude' => form_error('longitude'),
                        'kategori' => form_error('kategori')
                        )
                    ));
				exit();
			} else {
               $insert_data = array(
                    'nama' => $this->input->post('nama'),
                    'lokasi' => $this->input->post('lokasi'),
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude'),
                    'kategori_id_kategori' => $this->input->post('kategori'),
                    'id_pengguna' => $this->session->userdata('id')
                );
				//save to database
				$this->Prasarana_model->save($insert_data);
				$this->session->set_flashdata('sukses', 'sukses tambah Prasana');
				echo json_encode(array('error' => 1, 'message' => 'sukses tambah Prasarana', 'url' => site_url('prasarana')));
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
				$get_data = $this->Prasarana_model->get_by_id(['id' => $id]);
				if ($get_data) {
					echo json_encode(['error' => 1, 'message' => 'data available.', 'data' => $get_data]);
					exit();
				} else {
					echo json_encode(['error' => 0, 'message' => 'no data found.', 'url' => site_url('prasarana')]);
					exit();
				}
			}
		}
		redirect('prasarana');
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_edit', 'Nama Karyawan', 'required');
			$this->form_validation->set_rules('lokasi_edit', 'Lokasi', 'required');
			$this->form_validation->set_rules('longitude_edit', 'Longitude', 'required');
			$this->form_validation->set_rules('latitude_edit', 'Latitude', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE) {
                echo json_encode([
                    'error' => 0,
                    'message' => [
                        'nama_edit' => form_error('nama_edit'),
                        'lokasi_edit' => form_error('lokasi_edit'),
                        'longitude_edit' => form_error('longitude_edit'),
                        'latitude_edit' => form_error('latitude_edit'),
                    ],
                    'url' => site_url('prasarana')]);
				exit();
			} else {
                $insert_data = array(
                            'nama' => $this->input->post('nama_edit'),
                            'lokasi' => $this->input->post('lokasi_edit'),
                            'longitude' => $this->input->post('longitude_edit'),
                            'latitude' => $this->input->post('latitude_edit'),
                            'kategori_id_kategori' => $this->input->post('kategori_edit'),
                            'id_pengguna' => $this->session->userdata('id')
                        );
				$this->Prasarana_model->update($insert_data, ['id' => $this->input->post('id_edit')]);
				$message = 'Data berhasil di update.';
				$this->session->set_flashdata('sukses', $message);
				echo json_encode(['error' => 1, 'message' => $message, 'url' => site_url('prasarana')]);
				exit();
			}

		}

		redirect('kategori');
	}
	public function destroy()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('prasarana_id');

			$data = $this->Prasarana_model->get_by_id(array('id' => $id));
			if ($data) {
				$this->Prasarana_model->destroy(array('id' => $id));
				$message = 'sukses menghapus data Prasarana';
				$this->session->set_flashdata('sukses', $message);
				echo json_encode(array('error' => 1, 'message' => $message, 'url' => site_url('prasarana')));
				exit();
			} else {
				$message = 'Data Prasaran tidak ditemukan';
                $this->session->set_flashdata('error', $message);
				echo json_encode(array('error' => 0, 'message' => $message, 'url' => site_url('prasarana')));
				exit();
			}
		}
		redirect('home');
	}
}
