<?php

Class Authenticate {

	var $CI = NULL;

	public function __construct()
	{
        // get CI's object
        $this->CI =& get_instance();
	}

    /**
     * Check user
     *
     * @return ses
     */
    public function login($array_data)
    {
        //cek from karyawan table
        $session_data = array();
        $this->CI->load->model('pengguna_model');
        $pengguna = $this->CI->pengguna_model->get_by_id($array_data);
        if ($pengguna) {
            $kar = (array) $pengguna;
            $this->CI->session->set_userdata($kar);
            redirect('home');
        } else {
            $this->CI->session->set_flashdata('error','Email atau Password tidak ada.');
            redirect('auth/login');
        }
    }

    /**
     * check user has login
     *
     * @return boolean
     */
    public function is_login()
    {
        return ($this->CI->session->userdata('id')) ? TRUE : FALSE;
    }

    /**
     * check if user already login
     *
     * @return response
     */
    public function check_login()
    {
        if ($this->is_login()) {
            return true;
        }
        redirect('auth/login');
    }

    /**
     * delete all session user
     *
     * @return response
     */
    public function logout()
    {
        $this->CI->session->sess_destroy();
        redirect('auth/login');
    }
    
    /**
     * only granted user can view
     *
     * @return void
     */
    public function granted_user($status)
    {
        $this->CI->load->model('pengguna_model');
        $user = $this->CI->pengguna_model->get_by_id([
            'id' => $this->CI->session->userdata('id'),
            'email' => $this->CI->session->userdata('email')
        ]);
        if ($user->status == $status) {
            return true;
        } else {
            redirect('auth/login');
        }
        
    }

    /**
     * The user can't access the function
     *
     * @return void
     */
    public function denied_user($status)
    {
        $this->CI->load->model('pengguna_model');
        $user = $this->CI->pengguna_model->get_by_id([
            'id' => $this->CI->session->userdata('id'),
            'email' => $this->CI->session->userdata('email')
        ]);
        if ($user->status == $status) {
            redirect('auth/login');
        } else {
            return true;
        }
        
    }


    
    
}
