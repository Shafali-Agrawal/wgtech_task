<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function verify_user()
	{
		$email_id = $this->input->post('email_id');
		$password = $this->input->post('password');

		//curl post request
		$ch = curl_init();
		$curlConfig = array(
			CURLOPT_URL            => base_url('api/Login_api/verify_user_login'),
			CURLOPT_HTTPHEADER  => array('Access-Control-Allow-Origin: *'),
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS     => array(
				'email_id' => $email_id,
				'password' => $password,
			)
		);
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($result);

		//print_r($result);

		if ($result->status) 
		{
			$token = $result->token;
			$user_name = $result->user_name;
			$email_id = $result->email_id;

			$session_data['user_name'] = $user_name;
			$session_data['email_id'] = $email_id;
			
			$this->session->set_userdata('login_token',$token);
			$this->session->set_userdata('login_info',$session_data);
			echo "success";
		}
		else
		{
			echo "user not found";
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('email_id');
		$this->session->sess_destroy();
		$this->load->view('login');
		//redirect('Login/index');
	}
}
