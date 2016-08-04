<?php

/**
* Class Kerusakan
*/
class Kerusakan extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['kerusakan_model','prasarana_model','pengguna_model','perbaikan_model','kerusakandetail_model']);
	}

	public function index()
	{
		$this->stencil->js(array('jquery.dataTables.min', 'dataTables.bootstrap.min','kerusakan/kerusakan.js'));
		$this->stencil->css('dataTables.bootstrap');
		
		$data['kerusakan'] = $this->kerusakan_model->get_all_kerusakan();
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

	public function edit_prasarana($id)
	{
		$this->form_validation->set_rules('nama_prasarana', 'Nama Prasarana', 'required');
		if ($this->form_validation->run() == false) {
			//get data kerusakan
			$data['kerusakan'] = $this->kerusakan_model->get_by_id(['id' => $id]);
			
			//get data prasarana
			$data['prasarana'] = $this->prasarana_model->get_all()->result();
			$this->stencil->paint('kerusakan/edit_prasarana', $data);	
		} else {
			//update data kerusakan dengan input prasarana
			$this->kerusakan_model->update([
					'id_prasarana' => $this->input->post('nama_prasarana')
				],
				['id' => $id]);
			$this->session->set_flashdata('sukses', 'Sukses Update Kerusakan');
			redirect('kerusakan');	

		}
	}

	public function edit_kerusakan($id,$status)
	{
		//update data kerusakan dengan input prasarana
		if ($id) {
			
			$this->kerusakan_model->update([
					'status' => $status
				],
				['id' => $id]);
			$this->session->set_flashdata('sukses', 'Sukses Update Kerusakan');
			redirect('kerusakan');	
		} else {
			redirect('kerusakan');
		}
	}

	public function buat_estimasi($id_kerusakan)
	{
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');
		//get data kerusakan
		$kerusakan = $this->kerusakan_model->get_by_id(['id' => $id_kerusakan]);
		$data['prasarana'] = $this->prasarana_model->get_by_id(['id' => $kerusakan->id_prasarana]);
		$data['pelapor'] = $this->pengguna_model->get_by_id(['id' => $kerusakan->id_pengguna]);
		$data['kerusakan'] = $kerusakan;
		if ($this->form_validation->run() == false) {
			
			//get session pembelian
			if (isset($_SESSION['pembelian'])) {
				$data['pembelian'] = $_SESSION['pembelian'];
			}
			$this->stencil->paint('kerusakan/buat_estimasi', $data);
		} else {
			if ($this->session->userdata('pembelian')) {
				$old = $this->session->userdata('pembelian');
				foreach ($old as $key => $value) {
					$old[] = $this->input->post();
				}
				$this->session->set_userdata('pembelian', $old);
			} else {
				$array = array();
				$array[] = $this->input->post();
				$this->session->set_userdata('pembelian', $array);
			}
			$this->session->set_flashdata('sukses', 'Berhasil Menambah Estimasi');
			$this->stencil->paint('kerusakan/buat_estimasi', $data);
		}
	}

	public function remove_ses_estimasi($id,$id_kerusakan)
	{
		unset($_SESSION['pembelian'][$id]);
		$this->session->set_flashdata('sukses', 'Berhasil Menghapus Estimasi');
		redirect('kerusakan/buat_estimasi/'.$id_kerusakan);
		// $this->stencil->paint('kerusakan/buat_estimasi', $data);
	}

	public function selesai_estimasi($id_kerusakan)
	{
		if ($id_kerusakan) {
			$session_pembelian = $_SESSION['pembelian'];
			foreach ($session_pembelian as $key => $value) {
				$session_pembelian[$key]['status'] = 1;
				$session_pembelian[$key]['id_kerusakan'] = $id_kerusakan;
			}
			
			foreach ($session_pembelian as $key => $value) {
				$this->perbaikan_model->save($value);
			}
			//unset session
			unset($_SESSION['pembelian']);

			//update status kerusakan
			$this->kerusakan_model->update([
				'status' => 5
				],[
				'id' => $id_kerusakan
				]);

			$this->session->set_flashdata('sukses', 'Berhasil Membuat Estimasi');
			redirect('kerusakan');
		}
	}

	public function detail_estimasi($id_kerusakan)
	{
		if ($id_kerusakan) {
			$data['estimasi'] = $this->perbaikan_model->get_all(['id_kerusakan' => $id_kerusakan])->result();
			$data['id_kerusakan'] = $id_kerusakan;
			$this->stencil->paint('kerusakan/detail_estimasi', $data);
		}
	}

	public function terima_estimasi($id_kerusakan)
	{
		if ($id_kerusakan) {
			//update perbaikan estimasi data
			$estimasi = $this->perbaikan_model->get_all(['id_kerusakan' => $id_kerusakan])->result();
			foreach ($estimasi as $key => $value) {
				$this->perbaikan_model->update(['status' => 2], ['id_kerusakan' => $id_kerusakan]);
			}

			//update status kerusakan
			$this->kerusakan_model->update(['status' => 6], ['id' => $id_kerusakan]);
			$this->session->set_flashdata('sukses', 'Berhasil Approve Estimasi');
			redirect('kerusakan');
		}
	}

	public function add()
	{
		$this->form_validation->set_rules('deskripsi','Deskripsi','required');
		$data['prasarana'] = $this->prasarana_model->get_all()->result();

		if ($this->form_validation->run() == false) {

			$this->stencil->paint('kerusakan/add', $data);
		} else {
			$config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['max_width']            = 1024;
            $config['max_height']           = 1024;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('foto'))
            {
                    // $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    $this->stencil->paint('kerusakan/add', $data);
            }
            else
            {
                    $uploadan = $this->upload->data();
                    $foto = $uploadan['file_name'];
                    
					$this->kerusakan_model->save([
							'tanggal' => date('Y-m-d'),
							'foto' => $foto,
							'deskripsi' => $this->input->post('deskripsi'),
							'status' => 1,
							'id_pengguna' => $this->session->userdata('id'),
							'id_prasarana' => $this->input->post('prasarana')
						]);
                    $this->session->set_flashdata('sukses', 'Berhasil Menambah Data Kerusakan');
                    redirect('kerusakan');
            }
		}
	}

	public function upload_laporan_lapangan($id_kerusakan,$status)
	{
		$this->form_validation->set_rules('deskripsi','Deskripsi','required');
		// $this->form_validation->set_rules('foto','Foto','required');
		$data['kerusakan'] = $this->kerusakan_model->get_by_id(['id' => $id_kerusakan]);
		$data['status'] = $status;
		if ($this->form_validation->run() == false) {
			$this->stencil->paint('kerusakan/upload_laporan_lapangan', $data);
		} else {
			$config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['max_width']            = 1024;
            $config['max_height']           = 1024;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('foto'))
            {
                    // $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    $this->stencil->paint('kerusakan/upload_laporan_lapangan', $data);
            }
            else
            {
            	
                    $uploadan = $this->upload->data();
                    $foto = $uploadan['file_name'];
                    
					$this->kerusakandetail_model->save([
							// 'tanggal' => date('Y-m-d'),
							'foto' => $foto,
							'deskripsi' => $this->input->post('deskripsi'),
							// 'status' => 1,
							// 'id_pengguna' => $this->session->userdata('id'),
							'id_kerusakan' => $id_kerusakan
						]);

					$this->kerusakan_model->update([
						'status' => $status
						],
						['id' => $id_kerusakan]);

                    $this->session->set_flashdata('sukses', 'Berhasil Update Data Kerusakan');
                    redirect('kerusakan');
            }
		}
	}
}