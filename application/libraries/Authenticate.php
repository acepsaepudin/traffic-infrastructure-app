<?php

Class Authenticate {

	var $CI = NULL;

	public function __construct()
	{
        // get CI's object
        $this->CI =& get_instance();
	}
}