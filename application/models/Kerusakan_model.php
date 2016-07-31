<?php
/**
* User modle
*/
class Kerusakan_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'kerusakan';
	}

	public function get_all_kerusakan()
	{
		//check pegawai kantor
		$kerusakan = '';
		// if ($this->session->userdata('status') == 5) {
		// 	// $kerusakan = $this->kerusakan_model->get_all('status in (1,3,4,6) order by tanggal desc')->result();
		// 	$kerusakan = $this->db->select('*')
		// 				->from($this->table)
		// 				->where_in('status', array(1,3,4,6))
		// 				->order_by('tanggal', 'desc')
		// 				->get();
		// }
		// if ($this->session->userdata('status') == 3) {
		// 	// $kerusakan = $this->kerusakan_model->get_all('status in (5,8) order by tanggal desc')->result();
		// 	$kerusakan = $this->db->select('*')
		// 				->from($this->table)
		// 				->where_in('status', array('5','8'))
		// 				->order_by('tanggal', 'desc')
		// 				->get();
		// }
		// if ($this->session->userdata('status') == 4) {
		// 	// $kerusakan = $this->kerusakan_model->get_all('status in (2,7) order by tanggal desc')->result();
		// 	$kerusakan = $this->db->select('*')
		// 				->from($this->table)
		// 				->where_in('status', array('2','7'))
		// 				->order_by('tanggal', 'desc')
		// 				->get();
		// }
		// if ($this->session->userdata('status') == 1) {
			// $kerusakan = $this->kerusakan_model->get_all('status in (1,2,3,4,5,6,7,8) order by tanggal desc')->result();
			$kerusakan = $this->db->select('*')
						->from($this->table)
						// ->where_in('status', array('5','8'))
						->order_by('tanggal', 'desc')
						->get();
		// }
		
		//data prasarana
		if ($kerusakan) {
			$kerusakan = $kerusakan->result();
			foreach ($kerusakan as $key => $value) {
				$nama_pras = $this->prasarana_model->get_by_id(['id' => $value->id_prasarana]);
				if ($nama_pras) {
					$kerusakan[$key]->nama_prasarana = $nama_pras->nama;
				} else {
					$kerusakan[$key]->nama_prasarana = 'Belum dimasukan prasarana';
				}
			}
		}

		return $kerusakan;
		
	}
}
