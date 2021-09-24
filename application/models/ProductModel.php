<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

	public function add_product($data)
	{
		$name = $data['name'];
		$price = $data['price'];
		$description = $data['description'];
		$pid = $data['id'];
		$email_id = $data['email_id'];
		$cr_date = $data['cr_date'];

		$id=0;

		//fetch user name
		$sql_user = "SELECT id FROM user WHERE email_id='".$email_id."'";
		$qry_user = $this->db->query($sql_user)->row();

		if(!empty($qry_user))
		{
			$id = $qry_user->id;
		}

		if($pid!=0)
		{
			//update product 
			$update = "UPDATE products
							SET name = '".$name."',
				                price = '".$price."',
				                description = '".$description."',
				                add_by_user = $id,
				                updated_at = '".$cr_date."'
							WHERE id = $pid ";
				return $this->db->query($update);
		}
		else
		{
			//insert product

			$sql_product = " INSERT INTO products
	             SET name = '".$name."',
	                 price = '".$price."',
	                 description = '".$description."',
	                 add_by_user = $id,
				     created_at = '".$cr_date."',
				     updated_at = '".$cr_date."' ";
			$qry_product = $this->db->query($sql_product);

			if($qry_product)
			{
			    return $qry_product;
			}
		}

	}

	public function fetch_product($id)
	{
		$this->db->select('id,name,price,description');
		$this->db->from('products');
		$this->db->where('id',$id);
		return $this->db->get();
	}

	public function delete_product($id)
	{	
		return $this->db->delete('products',['id'=>$id]);
	}

}