<?php
class Laporan extends MY_Controller {

    function __construct()
	{
		parent::__construct();
		$this->load->model('kerusakan_model');
		// $this->authenticate->granted_user(1);
	}

	public function index()
	{
		echo date('Y-m-t');
		die();
		$this->stencil->js(array('highcharts','laporan/laporan'));
		$this->stencil->paint('laporan/index');
	}

	public function get_kerusakan()
	{
		$end = date('Y-m-t');
		$exp = explode('-', $end);
		$array_data = array();
		$status = array(
			'1' => 'Kerusakan Baru',
			'2' => 'Pengecekan Tim Lapangan',
			'3' => 'Tidak Ada Kerusakan',
			'4' => 'Ada Kerusakan',
			'5' => 'Dibuat Estimasi Biaya Kerusakan',
			'6' => 'Estimasi Telah Di Approve',
			'7' => 'Perbaikan Tim Lapangan',
			'8' => 'Sudah Diperbaiki'
		);
		$array_status = array();
		for ($i=1; $i<=$exp[2] ; $i++) { 
			$array_status[1]['nama'] = $status['1'];
			$array_status[1]['data']['tgl_'.$i] = 0;

			$array_status[2]['nama'] = $status['2'];
			$array_status[2]['data']['tgl_'.$i] = 0;

			$array_status[3]['nama'] = $status['3'];
			$array_status[3]['data']['tgl_'.$i] = 0;

			$array_status[4]['nama'] = $status['4'];
			$array_status[4]['data']['tgl_'.$i] = 0;

			$array_status[5]['nama'] = $status['5'];
			$array_status[5]['data']['tgl_'.$i] = 0;

			$array_status[6]['nama'] = $status['6'];
			$array_status[6]['data']['tgl_'.$i] = 0;

			$array_status[7]['nama'] = $status['7'];
			$array_status[7]['data']['tgl_'.$i] = 0;

			$array_status[8]['nama'] = $status['8'];
			$array_status[8]['data']['tgl_'.$i] = 0;
		}
		for ($i=1; $i<=$exp[2]  ; $i++) { 
			$get_data_by_date = $this->kerusakan_model->get_all(['tanggal' => date('Y-m-'.$i)]);
				
			if ($get_data_by_date->num_rows() > 0) {

				foreach ($get_data_by_date->result() as $key => $value) {
					$to_int = explode('-', $value->tanggal);
					switch ($value->status) {
						case '1':
							$array_status[1]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
						case '2':
							$array_status[2]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
						case '3':
							$array_status[3]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
						case '4':
							$array_status[4]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
						case '5':
							$array_status[5]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
						case '6':
							$array_status[6]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
						case '7':
							$array_status[7]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
						case '8':
							$array_status[8]['data']['tgl_'.(int) $to_int[2]] +=1;
							break;
					}
				}
			}
		}
		echo '<pre>';
		print_r($array_status);
		echo '</pre>';
		exit;
	}
}