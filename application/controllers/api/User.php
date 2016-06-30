<?php


/**
 * Class User
 * @author lutfi
 */
class User extends CI_Controller
{
    /**
     * POST user register
     *
     * @return json
     */
    public function register()
    {
        $this->form_validation->set_rules('name', 'name' ,'required');
        $this->form_validation->set_rules('email', 'email' ,'required|is_unique[pelapor.email]|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('confirmation_password', 'password Confirmation', 'required|matches[password]');
        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                            'error' => 1,
                            'message' => validation_errors()
                        )
                    )
                );
        } else {
            
            $this->load->model('pelapor_model');
            $this->load->helper('string');
            $this->pelapor_model->save([
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'token' => random_string('unique'),
            ]);

            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                            'error' => 0,
                            'message' => 'Success Register'
                        )
                    )
                );
        }
    }

    /**
     * 
     *
     * @return json
     */
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email' ,'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                            'error' => 0,
                            'message' => 'Email or Password cannot be null'
                        )
                    )
                );
        } else {
            $this->load->model('pelapor_model');
            $user_data = $this->pelapor_model->get_by_id([
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')) 
            ]);
            if ($user_data) {
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                            'error' => 0,
                            'message' => 'Success get data',
                            'data' => [
                                'userid' => $user_data->id,
                                'token' => $user_data->token,
                                'email' => $user_data->email,
                                'nama' => $user_data->nama
                            ]
                        )
                    )
                );
            } else {
                return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                            'error' => 1,
                            'message' => 'Email or Password is wrong'
                        )
                    )
                );
            }
            
        }
        
    }

    /**
     * POST data lapor kerusakan
     *
     * @return json
     */
    public function lapor()
    {
        $this->form_validation->set_rules('deskripsi','Deskripsi', 'required');
        $this->form_validation->set_rules('foto','Foto', 'required');

        $this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(200)
                ->set_output(json_encode(array(
                            'error' => 0,
                            'message' => validation_errors()
                        )
                    )
                );
        } else {
            $image = $_POST['foto'];
            $des = $_POST['deskripsi'];
            $name_image = time().'.jpg';
            $path = "./uploads/".$name_image;
            file_put_contents($path,base64_decode($image));
            $data = [
                    'id_pelapor' => $this->input->post('id_pelapor'),
                    'tanggal' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'foto' => $name_image,
                    'deskripsi' => $this->input->post('deskripsi')
                ];
            $this->load->model('kerusakan_model');
            $this->kerusakan_model->save($data);

            return $this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode(array(
								'error' => 1,
								'message' => 'Berhasil melaporkan kerusakan'
							)
						)
					);
        }
    }
       
    
    
}
