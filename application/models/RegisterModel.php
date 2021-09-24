<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterModel extends CI_Model {

	public function create_users($data)
	{
		$name = $data['name'];
		$email_id = $data['email_id'];
		$password = md5($data['password']);

		$sql = "SELECT * FROM user WHERE email_id='".$email_id."'";
		$result = $this->db->query($sql)->row();

		
		if(!empty($result))
		{
			return FALSE;//email exist
		}
		else
		{
			$sql = " INSERT INTO user
             SET name = '".$name."',
                 email_id = '".$email_id."',
                 password = '".$password."' ";
		    $qry = $this->db->query($sql);

		    if($qry)
		    {
		       return $qry;
		    }
		}
	}

	
}
