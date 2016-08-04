<?php
/**
* User modle
*/
class Kerusakandetail_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'detail_kerusakan';
	}
}
