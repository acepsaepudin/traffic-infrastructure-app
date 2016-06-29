<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    /**
     * @param mixed 
     */
    public function __construct()
    {
        parent::__construct();
        //$this->authenticate->check_login();
    }
    
	public function index()
	{
        $this->stencil->title('Home');
		// $this->stencil->layout('admin_layout');
		// $this->stencil->slice('nav');
		$this->stencil->paint('home/index');
	}
}
