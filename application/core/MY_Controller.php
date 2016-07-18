<?php
/**
* 
*/
class MY_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->authenticate->check_login();
		$this->stencil->layout('admin_layout');
	}
}