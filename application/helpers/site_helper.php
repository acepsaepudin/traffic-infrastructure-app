<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
function konversi($config, $id)
{
	$CI =& get_instance();
    $CI->config->load('tia');
    $res = '';
    foreach ($CI->config->item($config) as $key => $value) {
        if ($id == $key) {
            $res = $value;
        }
    }
    return $res;
}