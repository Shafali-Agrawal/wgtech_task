<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{

		$this->load->view('dashboard');
	}


	public function new_product($id)
	{
		if($id==0)
		{
			$this->load->view('product');
		}
		else
		{
			$this->load->model('ProductModel');
			$required_data = $this->ProductModel->fetch_product($id);
			if(!empty($required_data))
			{
				$res=$required_data->result_array();
				$product_Data['result']=$res[0];
				$this->load->view('product',$product_Data);
			}
		}
		
	}

	public function create_new_product()
	{
		$name = $this->input->post('name');
		$price = $this->input->post('price');
		$description = $this->input->post('description');
		$id = $this->input->post('id');

		$email_id = $_SESSION['login_info']['email_id'];

		date_default_timezone_set('Asia/Kolkata');
		$current_date = date("Y-m-d");

		//curl post request
		$ch = curl_init();
		$curlConfig = array(
			CURLOPT_URL            => base_url('api/Product_api/create_product'),
			CURLOPT_HTTPHEADER  => array('Access-Control-Allow-Origin: *'),
			CURLOPT_POST           => true,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POSTFIELDS     => array(
				'name' => $name,
				'price' => $price,
				'description' => $description,
				'id' => $id,
				'email_id' =>$email_id,
				'cr_date' =>$current_date,
			)
		);
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);

		$result = json_decode($result);

		//print_r($result);die();

		echo $result->message;
	}

	public function delete_product()
	{
		$id = $this->input->post('id');

		$this->load->model('ProductModel');

		$result = $this->ProductModel->delete_product($id);

		if($result)
		{
			echo "PRODUCT DELETED";
		}
		else
		{
			echo "FAILED TO DELETE PRODUCT";
		}
		//echo $result;
	}
}
