<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');class Client_business extends CI_Controller {	public function your_business()	{		$this->load->view('client_your_business');	}	public function add_edit_gallery()	{		$this->load->view('client_gallery');	}	public function edit_business()	{		$this->load->view('client_edit_business');	}	public function timing_description()	{		$this->load->view('timing_description');	}	public function delete_business_info()	{		$ids = $_REQUEST['ids'];		$this->db->where('id', $ids);		$this->db->delete('information_business');		ob_get_clean();		header('Access-Control-Allow-Origin: *');		header('Content-Type: application/json');		echo json_encode(['status'=>1]);		exit;	}	public function update_business()	{		$name = $this->input->post('txtName');		$email = $this->input->post('txtEmail');		$phone = $this->input->post('txtPhone');		$cousine = $this->input->post('txtCousine');		$address = $this->input->post('txtAddress');		$website = $this->input->post('txtWebsite');		$facebook = $this->input->post('txtFacebook');		$twitter = $this->input->post('txtTwitter');		$edit_business_id = $this->input->post('edit_details_business');		$data = array(							'name' => $name,							'email' => $email,							'mobile' => $phone,							'cousine' => $cousine,							'address' => $address,							'website' => $website,							'facebook' => $facebook,							'twitter' => $twitter							);		$this->db->where('id', $edit_business_id);		$update_data = $this->db->update('information_business',$data);		if($update_data)		{				echo "<script>";				echo "alert('Business Updated successfully...!')";				echo "</script>";	   			$url = base_url().'/index.php/client_business/your_business/';	    		header("refresh:1;url=$url");		}		else		{				echo "<script>";				echo "alert('Error in updation...!')";				echo "</script>";		}		}}