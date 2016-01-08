<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	public function index()
	{
		$this->stencil->title('wkwkwk');
		// $this->stencil->layout('admin_layout');
		// $this->stencil->slice('nav');
		$this->stencil->paint('home/index');
	}
}
