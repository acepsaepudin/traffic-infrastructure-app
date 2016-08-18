<?php
/**
* 
*/
class Ajaxnotif extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(['kerusakan_model']);
	}

	public function get_kerusakan()
	{
		//get kerusakan
		//cek pegawai kantor
		$kerusakan = '';
		if ($this->session->userdata('status') == '5') {
			$kerusakan = $this->kerusakan_model->get_all('status in (1,3,4,6,8)');
		}
		//cek pegawai lapangan
		if ($this->session->userdata('status') == '4') {
			$kerusakan = $this->kerusakan_model->get_all('status in (2,7)');
		}
		//cek Kepala Dinas
		if ($this->session->userdata('status') == '3') {
			$kerusakan = $this->kerusakan_model->get_all('status in (5,8)');
		}

		
		if ($kerusakan->num_rows() > 0) {
			echo json_encode([
				'error' => 1,
				'total' => $kerusakan->num_rows()
				]);
			exit();
		} else {
			echo json_encode([
				'error' => 0,
				'total' => 0
				]);
			exit();
		}
	}
}