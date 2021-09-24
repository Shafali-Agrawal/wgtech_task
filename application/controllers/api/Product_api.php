<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Product_api extends REST_Controller {

	 public function __construct() {

       parent::__construct();

       $this->load->model('ProductModel');
       $this->load->library('Authorization_Token');
    }

    public function create_product_post()
    {
		  //header("Access-Control-Allow-Origin: *");

    	$data = array(
                      'name' => $this->input->post('name'),
                      'price' => $this->input->post('price'),
                      'description' => $this->input->post('description'),
                      'id' => $this->input->post('id'),
                      'email_id' => $this->input->post('email_id'),
                      'cr_date' => $this->input->post('cr_date'),
                   );

      if($data['id']!=0)
      {
        //edit product

        $required_data = $this->ProductModel->add_product($data);

        if($required_data)
        {

          $this->response([
                            'status' => true,
                            'message' => 'PRODUCT UPDATED'],200);
        }
        else
        {
          $this->response([
                            'status' => false,
                            'message' => 'FAILED TO UPDATE PRODUCT'],404);
        }
      }
      else
      {
        //insert product

        $required_data = $this->ProductModel->add_product($data);

        if($required_data)
        {

          $this->response([
                            'status' => true,
                            'message' => 'PRODUCT ADDED'],200);
        }
        else
        {
          $this->response([
                            'status' => false,
                            'message' => 'FAILED TO ADD PRODUCT'],404);
        }

      }

    }

}