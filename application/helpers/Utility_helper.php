<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('asset_url()'))
{
	function asset_url()
	{
	  return base_url().'assets/';
	}

	function image_url()
	{
		return base_url().'uploads/';
	}
}