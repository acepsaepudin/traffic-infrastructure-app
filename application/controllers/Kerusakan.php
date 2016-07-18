<?php

/**
* Class Kerusakan
*/
class Kerusakan extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['kerusakan_model','prasarana_model']);
	}

	public function index()
	{
		$this->stencil->js(array('jquery.dataTables.min', 'dataTables.bootstrap.min','karyawan/karyawan.js'));
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
}