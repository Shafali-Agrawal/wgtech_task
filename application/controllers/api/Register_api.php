<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Register_api extends REST_Controller {

	 public function __construct() {

       parent::__construct();

       $this->load->model('RegisterModel');
       $this->load->library('Authorization_Token');
    }

    public function user_register_post()
    {
      // 	$name = $this->input->post('name');
    		// $email = $this->input->post('email');
    		// $password = $this->input->post('password');
    		// $repeatpassword = $this->input->post('repeatpassword');

       $data = array(
                      'name' => $this->input->post('name'),
                      'email_id' => $this->input->post('email'),
                      'password' => $this->input->post('password'),
                      'repeatpassword' => $this->input->post('repeatpassword'),
                   );

    		if($data['password']!=$data['repeatpassword'])
    		{
    			$this->response([
                        'status' => false,
                        'message' => 'password_error'],404);
    		}
    		else
    		{

          $required_data = $this->RegisterModel->create_users($data);

          if($required_data)
          {
              $this->response([
                        'status' => true,
                        'message' => 'register successfull'],200);
          }
          else
          {
              $this->response([
                        'status' => false,
                        'message' => 'email exists'],404);
          }

    			
    		}
    }

}
