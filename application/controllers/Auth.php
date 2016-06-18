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

    /**
     * get login all users
     *
     * @return void
     */
    public function get_login()
    {
        $this->form_validation->set_rules('email', 'Email','required');
        $this->form_validation->set_rules('password','Password', 'required');

        if ($this->form_validation->run()==false) {
            $this->session->set_flashdata('error', 'Inputan tidak boleh kosong.');
            redirect('auth/login');
        } else {
            $input = ['email' => $this->input->post('email'), 'password' => md5($this->input->post('password'))];
            $this->authenticate->login($input);
        }
        
    }

    /**
     * get logout user
     *
     * @return response
     */
    public function get_logout()
    {
        $this->authenticate->logout();
    }
    
    
}
