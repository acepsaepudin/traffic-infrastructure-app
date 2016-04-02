<?php
class Karyawan extends MY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('Karyawan_model');
	}

    public function index()
    {
        $this->stencil->js(array('jquery.dataTables.min', 'dataTables.bootstrap.min','karyawan/karyawan.js'));
		$this->stencil->css('dataTables.bootstrap');
		$data['karyawan'] = $this->Karyawan_model->get_all()->result();
		
		$this->stencil->paint('karyawan/index', $data);
 
    }

	public function create()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nama', 'Nama Karyawan', 'required');
			$this->form_validation->set_rules('notlp', 'Nomor Telepon', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[karyawan.email]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'error' => 0,
                    'message' => array(
                        'nama' => form_error('nama'),
                        'notlp' => form_error('notlp'),
                        'email' => form_error('email'),
                        'alamat' => form_error('alamat')
                        )
                    ));
				exit();
			} else {
                $insert_data = array(
                            'nama' => $this->input->post('nama'),
                            'notlpn' => $this->input->post('notlp'),
                            'alamat' => $this->input->post('alamat'),
                            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                            'email' => $this->input->post('email'),
                            'jabatan' => $this->input->post('jabatan')
                        );
				//save to database
				$this->Karyawan_model->save($insert_data);
				$this->session->set_flashdata('sukses', 'sukses tambah Karyawan');
				echo json_encode(array('error' => 1, 'message' => 'sukses tambah Karyawan', 'url' => site_url('Karyawan')));
				exit();
			}
		}
		redirect('home');
	}

}
