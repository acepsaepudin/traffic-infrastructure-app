<?php
class Pengguna extends MY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('pengguna_model');
		$this->authenticate->granted_user(1);
	}

    public function index()
    {
    	//load config
    	$this->config->load('tia');

        $this->stencil->js(array('jquery.dataTables.min', 'dataTables.bootstrap.min','karyawan/karyawan.js'));
		$this->stencil->css('dataTables.bootstrap');
		$data['karyawan'] = $this->pengguna_model->get_all()->result();
		$data['jabatan'] = $this->config->item('status_pengguna');
		$this->stencil->paint('karyawan/index', $data);
 
    }

	public function create()
	{
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
			$this->form_validation->set_rules('notlp', 'Nomor Telepon', 'required|numeric');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pengguna.email]');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE) {
                echo json_encode(array(
                    'error' => 0,
                    'message' => array(
                        'nama' => form_error('nama'),
                        'notlp' => form_error('notlp'),
                        'email' => form_error('email'), 'alamat' => form_error('alamat'),
                        'password' => form_error('password')
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
                            'status' => $this->input->post('jabatan'),
                            'password' => md5($this->input->post('password'))

                        );
				//save to database
				$this->pengguna_model->save($insert_data);
				$this->session->set_flashdata('sukses', 'sukses tambah Pengguna');
				echo json_encode(array('error' => 1, 'message' => 'sukses tambah Pengguna', 'url' => site_url('pengguna')));
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
				$get_data = $this->pengguna_model->get_by_id(['id' => $id]);
				if ($get_data) {
					echo json_encode(['error' => 1, 'message' => 'data available.', 'data' => $get_data]);
					exit();
				} else {
					echo json_encode(['error' => 0, 'message' => 'no data found.', 'url' => site_url('pengguna')]);
					exit();
				}
			}
		}
		redirect('kategori');
	}

	public function update()
	{
		if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('nama_edit', 'Nama Karyawan', 'required');
			$this->form_validation->set_rules('notlp_edit', 'Nomor Telepon', 'required|numeric');
			$this->form_validation->set_rules('email_edit', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('alamat_edit', 'Alamat', 'required');
			$this->form_validation->set_error_delimiters('', '');
			if ($this->form_validation->run() == FALSE) {
                echo json_encode([
                    'error' => 0,
                    'message' => [
                        'nama_edit' => form_error('nama_edit'),
                        'notlp_edit' => form_error('notlp_edit'),
                        'email_edit' => form_error('email_edit'),
                        'alamat_edit' => form_error('alamat_edit'),
                    ],
                    'url' => site_url('kategori')]);
				exit();
			} else {
                $insert_data = array(
                            'nama' => $this->input->post('nama_edit'),
                            'notlpn' => $this->input->post('notlp_edit'),
                            'alamat' => $this->input->post('alamat_edit'),
                            'jenis_kelamin' => $this->input->post('jenis_kelamin_edit'),
                            'email' => $this->input->post('email_edit'),
                            'status' => $this->input->post('jabatan_edit')
                        );
				$this->pengguna_model->update($insert_data, ['id' => $this->input->post('id_edit')]);
				$message = 'Data berhasil di update.';
				$this->session->set_flashdata('sukses', $message);
				echo json_encode(['error' => 1, 'message' => $message, 'url' => site_url('pengguna')]);
				exit();
			}

		}

		redirect('kategori');
	}
	public function destroy()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('karyawan_id');

			$data = $this->pengguna_model->get_by_id(array('id' => $id));
			if ($data) {
				$this->pengguna_model->destroy(array('id' => $id));
				$message = 'sukses menghapus data pengguna';
				$this->session->set_flashdata('sukses', $message);
				echo json_encode(array('error' => 1, 'message' => $message, 'url' => site_url('pengguna')));
				exit();
			} else {
				$message = 'Data pengguna tidak ditemukan';
                $this->session->set_flashdata('error', $message);
				echo json_encode(array('error' => 0, 'message' => $message, 'url' => site_url('pengguna')));
				exit();
			}
		}
		redirect('home');
	}
}
