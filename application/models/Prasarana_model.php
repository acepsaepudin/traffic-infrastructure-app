<?php
/**
* Kategori modle
*/
class Prasarana_model extends MY_Model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'prasarana';
	}
}
