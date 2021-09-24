<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Login_api extends REST_Controller {

	 public function __construct() {

       parent::__construct();

       $this->load->model('LoginModel');
       $this->load->library('Authorization_Token');
    }

    public function verify_user_login_post()
    {
		//header("Access-Control-Allow-Origin: *");

    	$data = array(
                      'email_id' => $this->input->post('email_id'),
                      'password' => $this->input->post('password')
                   );

  		$required_data = $this->LoginModel->users_login($data);

  		if($required_data!="not found")
  		{

  			 // you user authentication code will go here, you can compare the user with the database or whatever
  		    $payload = [
  		      'name' => $required_data,
  		      'email_id' => $data['email_id'],
  		    ];

  		    // generate a token
      		$token = $this->authorization_token->generateToken($payload);

  			$this->response([
                          'status' => true,
        					'token' => $token,
        					'user_name' => $required_data,
        					'email_id' => $data['email_id'],
                          'message' => 'login successfull'],200);
  		}
  		else
  		{
  			$this->response([
                          'status' => false,
                          'message' => 'not_matched'],404);
  		}
    }

}