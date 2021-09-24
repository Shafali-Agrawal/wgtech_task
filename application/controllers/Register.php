<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct() {
        parent::__construct();

        $this->load->model('RegisterModel');
    }

	public function index()
	{
		$this->load->view('register');
	}

	public function register_acct()
	{
		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$name = $firstname." ".$lastname;
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$repeatpassword = $this->input->post('repeatpassword');

		//curl post request
		$ch = curl_init();
		$curlConfig = array(
			CURLOPT_URL            => base_url('api/Register_api/user_register'),
			CURLOPT_HTTPHEADER  => array('Access-Control-Allow-Origin: *'),
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS     => array(
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'repeatpassword' => $repeatpassword,
			)
		);
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($result);

		//print_r($result);


		if($result->status)
		{
			echo "register successfull";
		}
		else if($result->message=='password_error')
		{
			echo "password_error";
		}
		else
		{
			echo "email_exists";
		}

	}
}
