<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

	public function users_login($data)
	{
		$email_id = $data['email_id'];
		$password = md5($data['password']);

		$sql = "SELECT name FROM user WHERE email_id = '".$email_id."' AND password = '".$password."' ";
		$qry = $this->db->query($sql)->row();

		if(!empty($qry))
		{
			return $qry->name;
		}
		else
		{
			return "not found";
		}
	}

}