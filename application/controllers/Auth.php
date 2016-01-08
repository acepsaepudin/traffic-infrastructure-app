<?php
/**
* 
*/
class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function login()
	{
		return $this->load->view('login');
	}
}