<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function test()
	{
			echo 'test';
	}
	public function index()
	{
			$this->load->view('header_client');
			$this->load->view('index');
			$this->load->view('footer_client');
	}
	public function admin()
	{
			$this->load->view('header_admin');
			$this->load->view('index');
			$this->load->view('footer_admin');
	}
	public function zone_manager()
	{
			$this->load->view('header_zone_manager');
			$this->load->view('zone_manager_index');
			$this->load->view('footer_zone_manager');
	}
	public function login()
	{
			$this->load->view('login');
	}
	public function check_login()
	{
			parse_str($_SERVER['QUERY_STRING'],$_REQUEST);
			$user_email=$this->input->post('txtEmail');
    		$user_pass=$this->input->post('txtPassword');  

    		$result_login = $this->db->query("select * from admin where email='$user_email' and password='$user_pass'");

    		if($result_login -> num_rows > 0) 
    		{
		    		$row_login = $result_login->result();
		    		if($row_login['0']->type == '1')
		    		{
		    				//session start for admin
		    				$newdata = array(
								               'email_admin'     => $row_login['0']->email,
								               'id' 			 => $row_login['0']->id,
								               'logged_in' => TRUE
								           );
							$this->session->set_userdata($newdata);
		    				// Admin's Area
		    				$this->session->set_userdata('some_name', 'some_value');
		    				// $this->load->view('header_admin');
		    				// $this->load->view('index');
		    				// $this->load->view('footer_admin');
		    				redirect('Home/admin');
		    		}
		    		if($row_login['0']->type == '0')
		    		{
		    				//session start for client
		    				$newdata = array(
								               'email_client'     => $row_login['0']->email,
								               'id' 			  => $row_login['0']->id,
								               'logged_in' => TRUE
								           );
							$this->session->set_userdata($newdata);

		    				// client's Area
		    				redirect('Home/index');
		    		}
		    		if($row_login['0']->type == '3')
		    		{
		    				// echo "zone manager";
		    				// exit();
		    				//session start for client
		    				$newdata = array(
								               'email_zone_manager'     => $row_login['0']->email,
								               'zone_manager_id' 			  => $row_login['0']->id,
								               'logged_in' => TRUE
								           );
							$this->session->set_userdata($newdata);

		    				// client's Area
		    				redirect('Home/zone_manager');
		    		}
		    }
		    else
		    {
		    		echo "<script>";
		    		echo "alert('User not Found');";
		    		echo "</script>";
		    		$url = base_url().'/index.php/Home/login';
		    		header("refresh:0.01;url=$url");
		    }
	}
	public function change_password_client()
	{
		$this->load->view('change_password_client');
	}
	public function change_password_admin()
	{
		$this->load->view('change_password_admin');
	}
	public function change_password_zone_manager()
	{
		$this->load->view('change_password_zone_manager');
	}

	public function change_password_edit_zone_manager()
	{
		$currentpassword = $_POST['txtCurrentPassword'];
		$newpassword = $_POST['txtNewPassword'];
		$renewpassword = $_POST['txtRePassword'];
		$email_zone_manager =  $this->session->userdata('email_zone_manager');
		$res_password =  $this->db->query("select * from admin where email='$email_zone_manager' and password='$currentpassword'");
		$row_password = $res_password->result();  
		$user_type = $row_password['type'];
		if($res_password -> num_rows > 0)
		{
			// $this->db->set('password', $newpassword);
			// $this->db->where('id',$row_password['0']->password);
			// $this->db->update('admin');

			$update_password = $this->db->query("update admin set password='$newpassword' where email='$email_zone_manager'");

			if($update_password)
			{
					echo "<script>";
					echo "alert('password successfully changed');";
					echo "</script>";
					$url = base_url().'/index.php/Home/change_password_zone_manager';
					header("refresh:0.1;url=$url");
			}	
			else
			{
					echo "<script>";
					echo "alert('Error in updation');";
					echo "</script>";
					$url = base_url().'/index.php/Home/change_password_zone_manager';
					header("refresh:0.1;url=$url");
			}
		}
		else
		{
			echo "<script>";
			echo "alert('Current Password doesn't match');";
			echo "</script>";
			$url = base_url().'/index.php/Home/change_password_zone_manager';
			header("refresh:0.1;url=$url");
		}
	}

	public function change_password_edit_admin()
	{	
		$currentpassword = $_POST['txtCurrentPassword'];
		$newpassword = $_POST['txtNewPassword'];
		$renewpassword = $_POST['txtRePassword'];
		$email_admin =  $this->session->userdata('email_admin');
		$res_password =  $this->db->query("select * from admin where email='$email_admin' and password='$currentpassword'");
		$row_password = $res_password->result();  
		$user_type = $row_password['type'];
		if($res_password -> num_rows > 0)
		{
			// $this->db->set('password', $newpassword);
			// $this->db->where('id',$row_password['0']->password);
			// $this->db->update('admin');

			$update_password = $this->db->query("update admin set password='$newpassword' where email='$email_admin'");

			if($update_password)
			{
					echo "<script>";
					echo "alert('password successfully changed');";
					echo "</script>";
					$url = base_url().'/index.php/Home/change_password_admin';
					header("refresh:0.1;url=$url");
			}	
			else
			{
					echo "<script>";
					echo "alert('Error in updation');";
					echo "</script>";
					$url = base_url().'/index.php/Home/change_password_admin';
					header("refresh:0.1;url=$url");
			}
		}
		else
		{
			echo "<script>";
			echo "alert('Current Password doesn't match');";
			echo "</script>";
			$url = base_url().'/index.php/Home/change_password_admin';
			header("refresh:0.1;url=$url");
		}

	}
	public function change_password_edit()
	{
		$currentpassword = $_POST['txtCurrentPassword'];
		$newpassword = $_POST['txtNewPassword'];
		$renewpassword = $_POST['txtRePassword'];
		$email_client =  $this->session->userdata('email_client');
		$res_password =  $this->db->query("select * from admin where email='$email_client' and password='$currentpassword'");
		$row_password = $res_password->result();  
		$user_type = $row_password['type'];
		if($res_password -> num_rows > 0)
		{
			// $this->db->set('password', $newpassword);
			// $this->db->where('id',$row_password['0']->password);
			// $this->db->update('admin');

			$update_password = $this->db->query("update admin set password='$newpassword' where email='$email_client'");

			if($update_password)
			{
					echo "<script>";
					echo "alert('password successfully changed');";
					echo "</script>";
					$url = base_url().'/index.php/Home/change_password_client';
					header("refresh:0.1;url=$url");
			}	
			else
			{
					echo "<script>";
					echo "alert('Error in updation');";
					echo "</script>";
					$url = base_url().'/index.php/Home/change_password_client';
					header("refresh:0.1;url=$url");
			}
		}
		else
		{
			echo "<script>";
			echo "alert('Current Password doesn't match');";
			echo "</script>";
			$url = base_url().'/index.php/Home/change_password_client';
			header("refresh:0.1;url=$url");
		}
	}
	
	public function logout()
	{	
		$this->session->sess_destroy();
		redirect('Home/login');
	}
}